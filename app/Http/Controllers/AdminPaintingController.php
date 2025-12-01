<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPaintingController extends Controller
{
    // Show the admin list of all paintings with rating stats
    public function index(Request $request)
    {
        $continents = ['asia','afrika','eropa','amerika','australia','antartika','oseania'];
        $rows = [];
        foreach ($continents as $c) {
            $file = resource_path('views/documentation/data/'.$c.'.php');
            if (file_exists($file)) {
                $arr = include $file;
                foreach ($arr as $p) {
                    $slug = $p['slug'] ?? null;
                    $ratingFile = storage_path('app/ratings/'.Str::slug($slug).'.json');
                    $avg = 0; $count = 0; $comments = [];
                    if (file_exists($ratingFile)) {
                        $payload = json_decode(file_get_contents($ratingFile), true);
                        $ratings = $payload['ratings'] ?? [];
                        $count = count($ratings);
                        if ($count) $avg = round(array_sum(array_column($ratings, 'rating')) / $count, 2);
                        $comments = array_filter($ratings, fn($r) => !empty($r['comment']));
                    }
                    $rows[] = [
                        'slug' => $slug,
                        'title' => $p['title'] ?? '',
                        'continent' => ucfirst($c),
                        'avg' => $avg,
                        'count' => $count,
                        'comments' => $comments,
                    ];
                }
            }
        }
        return view('admin.paintings.index', ['rows' => $rows]);
    }

    protected function continentList()
    {
        return ['asia','afrika','eropa','amerika','australia','antartika','oseania'];
    }

    protected function loadContinent($continent)
    {
        $file = resource_path('views/documentation/data/'.strtolower($continent).'.php');
        if (!file_exists($file)) return [];
        return include $file;
    }

    protected function saveContinent($continent, $arr)
    {
        $file = resource_path('views/documentation/data/'.strtolower($continent).'.php');
        $content = "<?php\n// " . ucfirst($continent) . " paintings — edit here to update the " . ucfirst($continent) . " painting set.\nreturn ";
        $content .= var_export($arr, true) . ";\n";
        file_put_contents($file, $content);
    }

    public function create()
    {
        $continents = $this->continentList();
        return view('admin.paintings.create', compact('continents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'continent' => 'required|string',
            'slug' => 'nullable|string',
            'title' => 'required|string',
            'artist' => 'nullable|string',
            'year' => 'nullable|string',
            'img' => 'nullable|string',
            'desc' => 'nullable|string',
        ]);
        $continent = strtolower($data['continent']);
        $arr = $this->loadContinent($continent);
        $slug = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['title']);
        // ensure unique
        $exists = collect($arr)->contains(fn($p) => ($p['slug'] ?? '') === $slug);
        if ($exists) return back()->withErrors(['slug' => 'Slug already exists for this continent'])->withInput();
        $item = [
            'slug' => $slug,
            'title' => $data['title'],
            'artist' => $data['artist'] ?? '',
            'continent' => ucfirst($continent),
            'year' => $data['year'] ?? '',
            'img' => $data['img'] ?? '',
            'desc' => $data['desc'] ?? '',
        ];
        $arr[] = $item;
        $this->saveContinent($continent, $arr);
        return redirect()->route('admin.paintings.index')->with('success','Painting added');
    }

    public function edit($continent, $slug)
    {
        $continent = strtolower($continent);
        $arr = $this->loadContinent($continent);
        $p = collect($arr)->first(fn($p) => ($p['slug'] ?? '') === $slug);
        if (!$p) abort(404);
        $continents = $this->continentList();
        return view('admin.paintings.edit', compact('p','continents','continent'));
    }

    public function update(Request $request, $continent, $slug)
    {
        $continent = strtolower($continent);
        $data = $request->validate([
            'slug' => 'nullable|string',
            'title' => 'required|string',
            'artist' => 'nullable|string',
            'year' => 'nullable|string',
            'img' => 'nullable|string',
            'desc' => 'nullable|string',
        ]);
        $arr = $this->loadContinent($continent);
        $index = collect($arr)->search(fn($p) => ($p['slug'] ?? '') === $slug);
        if ($index === false) abort(404);
        $newSlug = $data['slug'] ? Str::slug($data['slug']) : $slug;
        // check for slug conflicts
        foreach ($arr as $i => $it) {
            if ($i !== $index && ($it['slug'] ?? '') === $newSlug) {
                return back()->withErrors(['slug' => 'Slug already exists'])->withInput();
            }
        }
        $arr[$index]['slug'] = $newSlug;
        $arr[$index]['title'] = $data['title'];
        $arr[$index]['artist'] = $data['artist'] ?? '';
        $arr[$index]['year'] = $data['year'] ?? '';
        $arr[$index]['img'] = $data['img'] ?? '';
        $arr[$index]['desc'] = $data['desc'] ?? '';
        $this->saveContinent($continent, $arr);
        return redirect()->route('admin.paintings.index')->with('success','Painting updated');
    }

    public function destroy($continent, $slug)
    {
        $continent = strtolower($continent);
        $arr = $this->loadContinent($continent);
        $arr = array_filter($arr, fn($p) => ($p['slug'] ?? '') !== $slug);
        $this->saveContinent($continent, array_values($arr));
        // remove ratings file if present
        $ratingFile = storage_path('app/ratings/'.Str::slug($slug).'.json');
        if (file_exists($ratingFile)) unlink($ratingFile);
        return redirect()->route('admin.paintings.index')->with('success','Painting removed');
    }
}
