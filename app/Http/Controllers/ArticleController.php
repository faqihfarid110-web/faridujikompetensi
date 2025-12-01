<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Show a grid of continents (basic concept page).
     */
    public function index()
    {
        $continents = $this->getContinents();

        return view('articles.index', compact('continents'));
    }

    /**
     * Helper: returns the continents used across views and logic (Antarctica removed).
     */
    private function getContinents()
    {
        return [
            'asia' => ['name' => 'Asia', 'abbr' => 'AS', 'logo' => '🌏'],
            'europe' => ['name' => 'Eropa', 'abbr' => 'EU', 'logo' => '🌍'],
            'north-america' => ['name' => 'Amerika Utara', 'abbr' => 'NA', 'logo' => '🌎'],
            'south-america' => ['name' => 'Amerika Selatan', 'abbr' => 'SA', 'logo' => '🗺️'],
            'africa' => ['name' => 'Afrika', 'abbr' => 'AF', 'logo' => '🌍'],
            'oceania' => ['name' => 'Oseania', 'abbr' => 'OC', 'logo' => '🌊'],
        ];
    }

    /**
     * Show countries for a specific continent.
     */
    public function show(Request $request, $continent)
    {
        // Make sure we have the same continents list available here
        $continents = $this->getContinents();

        // List of all countries grouped by continent, excluding Indonesia (code 'id')
        $allCountries = json_decode(file_get_contents(base_path('resources/data/countries.json')), true);
        $data = [];
        foreach ($continents as $key => $info) {
            $countries = array_filter($allCountries, function($country) use ($key) {
                // Exclude Indonesia
                return strtolower($country['continent']) === $key && strtolower($country['code']) !== 'id';
            });
            $data[$key] = [
                'name' => $info['name'],
                'countries' => array_values($countries),
            ];
        }

        if (!array_key_exists($continent, $data)) {
            abort(404);
        }

        $continentData = $data[$continent];
        $continentData['slug'] = $continent;

        return view('articles.show', ['continent' => $continentData]);
    }

    /**
     * Show a continent history/overview page.
     */
    public function history(Request $request, $continent)
    {
        $continents = $this->getContinents();
        if (!array_key_exists($continent, $continents)) abort(404);

        $continentData = $continents[$continent];
        $continentData['slug'] = $continent;
        // This placeholder 'overview' can be replaced with full content later or fetched from DB.
        $continentData['overview'] = "Kumpulan sejarah dan ringkasan perkembangan '" . $continentData['name'] . "' — mulai dari peradaban, konflik, dan perkembangan budaya. Gunakan halaman ini untuk menambahkan artikel ringkasan benua.";

        return view('articles.history', ['continent' => $continentData]);
    }
}
