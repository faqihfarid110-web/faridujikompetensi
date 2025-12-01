<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Funfact;
use App\Models\FunfactFeedback;
class FunfactController extends Controller {
    public function index(Request $request) {
        // Redirect to default category (politik) instead of showing 'semua'
        return redirect()->route('funfact.category', ['topic' => 'politik']);
    }

    public function category($topic) {
        $page = max(1, (int) request()->query('page', 1));
        $perPage = 10;
        $items = $this->loadTopicItems($topic);
        if (empty($items)) return $this->index(request());
        // Ensure category metadata for each item
        foreach ($items as &$it) {
            if (!isset($it['category'])) $it['category'] = strtolower($topic);
        }
        $total = count($items);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $start = ($page - 1) * $perPage;
        $paginated = array_slice($items, $start, $perPage);
        // If this is an AJAX or JSON request, return JSON to support client-side rendering
        if (request()->wantsJson() || request()->ajax() || request()->header('Accept') === 'application/json') {
            return response()->json([
                'items' => array_values($paginated),
                'category' => $topic,
                'page' => $page,
                'perPage' => $perPage,
                'total' => $total,
                'totalPages' => $totalPages,
            ]);
        }
        return view('funfact', ['items' => $paginated, 'category' => $topic, 'page' => $page, 'perPage' => $perPage, 'total' => $total, 'totalPages' => $totalPages]);
    }
    
    /**
     * Load all items from app/Data/FunfactTopics with caching.
     * Cache key: funfact.items.all
     */
    private function loadAllItems() {
        return Cache::remember('funfact.items.all', 60, function () {
            $dir = app_path('Data/FunfactTopics');
            $items = [];
            if (is_dir($dir)) {
                foreach (glob($dir . DIRECTORY_SEPARATOR . '*.php') as $file) {
                    $list = require $file;
                    if (is_array($list)) {
                        foreach ($list as $it) {
                            if (!isset($it['slug'])) continue;
                            if (!isset($it['category'])) {
                                $it['category'] = strtolower(pathinfo($file, PATHINFO_FILENAME));
                            }
                            $items[] = $it;
                        }
                    }
                }
            }
            return $items;
        });
    }

    /**
     * Load items for a single topic file with caching.
     */
    private function loadTopicItems($topic) {
        $key = 'funfact.items.topic.' . strtolower($topic);
        return Cache::remember($key, 60, function () use ($topic) {
            $dir = app_path('Data/FunfactTopics');
            $topicCandidate = ucfirst(strtolower($topic));
            $fileA = $dir . DIRECTORY_SEPARATOR . $topicCandidate . '.php';
            $fileB = $dir . DIRECTORY_SEPARATOR . strtolower($topic) . '.php';
            if (file_exists($fileA)) return is_array($list = require $fileA) ? $list : [];
            if (file_exists($fileB)) return is_array($list = require $fileB) ? $list : [];
            return [];
        });
    }
    public function show($slug) {
        // Use cache when possible to reduce DB/file IO
        $cacheKey = 'funfact.slug.' . $slug;
        $funfact = Cache::remember($cacheKey, 60, function () use ($slug) {
            return Funfact::where('slug', $slug)->first();
        });
        $all = [
            'tersambar-petir-di-depok' => [
                'title' => 'Tersambar Petir di Depok',
                'category' => 'sains',
                'summary' => 'Depok terkenal dengan sambaran petirnya. Banyak memakan korban, sedari dulu hingga hari ini.',
                'img' => 'assets/images/courses/courseone.png',
                'source' => 'historia.id/article/tersambar-petir-di-depok',
                'author' => 'Petrik Matanasi',
                'date' => '21 Oktober 2025',
                'content' => 'Depok terkenal dengan sambaran petirnya. Banyak korban direkam sejak zaman dulu; potret, catatan, dan berita lokal menyingkap pola geografi dan kepercayaan yang memengaruhi kehidupan masyarakat. (Konten panjang dikembangkan untuk kebutuhan halaman detail.)'
            ],
            'pemilu-kecil-bersejarah' => [
                'title' => 'Pemilu Kecil yang Bersejarah',
                'category' => 'politik',
                'summary' => 'Sebuah kota kecil pernah melakukan pemilu yang membingungkan tetapi berpengaruh kuat pada arsitektur politik lokal.',
                'img' => 'assets/images/testimonial/userone.png',
                'source' => 'historia.id/article/pemilu-kecil-bersejarah',
                'author' => 'Redaksi',
                'date' => '12 Mei 2025',
                'content' => 'Kisah panjang tentang pemilu kecil ini, latar, dampak, dan sumber arsip yang menjelaskan perubahan politik lokal.'
            ],
            'nama-tradisi-salah-tafsir' => [
                'title' => 'Nama Tradisi yang Salah Tafsir',
                'category' => 'kultur',
                'summary' => 'Sebuah festival yang awalnya tahayul kini dikenal sebagai simbol kebanggaan budaya setempat.',
                'img' => 'assets/images/courses/coursetwo.png',
                'source' => 'historia.id/article/nama-tradisi-salah-tafsir',
                'author' => 'Redaksi',
                'date' => '8 April 2025',
                'content' => 'Rangkaian artikel yang menjabarkan asal usul, transformasi, dan interpretasi nama tradisi tersebut.'
            ],
            'kapal-hantu' => [
                'title' => 'Kapal yang Dikira Hantu',
                'category' => 'militer',
                'summary' => 'Sebuah kapal perang dikira hantu oleh nelayan setempat ketika muncul kabut tebal.',
                'img' => 'assets/images/courses/coursethree.png',
                'source' => 'historia.id/article/kapal-hantu',
                'author' => 'Redaksi',
                'date' => '2 Februari 2025',
                'content' => 'Narasi kapal misterius dan bagaimana legenda mempengaruhi narasi lokal tentang keamanan maritim.'
            ],
            'koin-salah-cetak' => [
                'title' => 'Koin yang Salah Cetak',
                'category' => 'ekonomi',
                'summary' => 'Sebuah cetakan koin langka justru membuat ekonomi lokal terpeleset, lalu pulih dengan cara unik.',
                'img' => 'assets/images/banner/mahila-ship.jpg',
                'source' => 'historia.id/article/koin-salah-cetak',
                'author' => 'Redaksi',
                'date' => '15 Januari 2025',
                'content' => 'Sejarah ekonomi lokal dan efek sebuah kesalahan percetakan koin yang kini menjadi barang koleksi.'
            ],
            'patung-dipindahkan' => [
                'title' => 'Patung yang Dipindahkan Malam Hari',
                'category' => 'kuno',
                'summary' => 'Patung kuno yang dipindahkan diam-diam dari satu situs ke situs lain di malam hari, menimbulkan spekulasi dan legenda.',
                'img' => 'assets/images/courses/courseone.png',
                'source' => 'historia.id/article/patung-dipindahkan',
                'author' => 'Redaksi',
                'date' => '7 Maret 2025',
                'content' => 'Penyelidikan mengenai pemindahan artefak, motif, dan rekaman historis yang menyertai peristiwa tersebut.'
            ],
            'riwayat-lolosnya-norwegia-piala-dunia-2026' => [
                'title' => 'Kebangunan Bangsa Viking: Riwayat Lolosnya Norwegia ke Piala Dunia 2026',
                'category' => 'olahraga',
                'summary' => 'Perjalanan Norwegia menuju Piala Dunia 2026 — kerja keras dan kebersamaan tim.',
                'img' => 'assets/images/courses/coursetwo.png',
                'source' => 'historia.id/article/riwayat-lolosnya-norwegia-piala-dunia-2026',
                'author' => 'Redaksi',
                'date' => '19 Juni 2025',
                'content' => 'Dalam lembar perjalanan sepak bola dunia, tahun 2026 menjadi penanda penting bagi Kerajaan Norwegia. Setelah sekian lama terpisah dari gelanggang tertinggi sepak bola internasional — terakhir menjejak Piala Dunia pada tahun 1998 — bangsa Viking akhirnya kembali memperoleh hak tampil di persada tersebut. (Ringkasan panjang dikembangkan di sini.)'
            ],
            'jalan-buntu-pasar' => [
                'title' => 'Jalan Buntu yang Jadi Pasar',
                'category' => 'urban',
                'summary' => 'Gang buntu yang akhirnya menjadi pasar kecil yang terkenal akan rempah-rempah lokal.',
                'img' => 'assets/images/courses/coursethree.png',
                'source' => 'historia.id/article/jalan-buntu-pasar',
                'author' => 'Redaksi',
                'date' => '28 Juli 2025',
                'content' => 'Studi urban tentang transformasi ruang publik yang sederhana menjadi pusat ekonomi mikro.'
            ],
        ];
        if ($funfact) {
            $data = $funfact->toArray();
        } else {
            // If the slug matches category-index and a per-topic file exists, prefer it
            if (preg_match('/^([a-z]+)-(\d+)$/', $slug, $m2)) {
                $cat = $m2[1];
                $dir = app_path('Data/FunfactTopics');
                $fileA = $dir . DIRECTORY_SEPARATOR . ucfirst($cat) . '.php';
                $fileB = $dir . DIRECTORY_SEPARATOR . strtolower($cat) . '.php';
                $topicFile = null;
                if (file_exists($fileA)) $topicFile = $fileA; elseif (file_exists($fileB)) $topicFile = $fileB;
                if ($topicFile) {
                    $list = require $topicFile;
                    if (is_array($list)) {
                        foreach ($list as $it) {
                            if (isset($it['slug']) && $it['slug'] === $slug) {
                                $data = $it;
                                break;
                            }
                        }
                    }
                }
            }
        
            if (!isset($data)) {
            if (!isset($all[$slug])) {
                // If slug follows the pattern category-index (e.g., politik-3), generate demo content
                if (preg_match('/^([a-z]+)-(\d+)$/', $slug, $matches)) {
                    $cat = $matches[1];
                    $idx = intval($matches[2]);
                    $known = array('sains','politik','kultur','militer','ekonomi','kuno','olahraga','urban');
                    if (in_array($cat, $known)) {
                        $data = [
                            'title' => ucfirst($cat) . ' Demo ' . $idx,
                            'category' => $cat,
                            'summary' => 'Ringkasan demo untuk ' . ucfirst($cat) . ' #' . $idx . '.',
                            'img' => 'assets/images/courses/courseone.png',
                            'source' => 'historia.id/article/'.$slug,
                            'author' => 'Redaksi',
                            'date' => date('d F Y', strtotime('-'.$idx.' days')),
                            'content' => 'Konten demo untuk '.ucfirst($cat).' nomor '.$idx.'. Ini adalah artikel lengkap yang di-generate otomatis untuk demo.',
                        ];
                    } else {
                        abort(404);
                    }
                } else {
                    abort(404);
                }
                } else {
                    $data = $all[$slug];
                }
            }
        }
        $feedbacks = FunfactFeedback::where('slug', $slug)->orderBy('created_at', 'desc')->get();
        $avg = $feedbacks->avg('rating') ?: null;
        $data['feedbacks'] = $feedbacks;
        $data['average_rating'] = $avg;
        $data['slug'] = $slug;
        return view('funfact.show', $data);
    }
}
