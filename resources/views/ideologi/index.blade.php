{{--
  DEPRECATED FILE
  The original `resources/views/ideologi/index.blade.php` previously included accidentally placed controller code.
  This file is kept only as a placeholder so the view folder no longer contains executable controller classes.
  Use `resources/views/ideologi.blade.php` to edit the combined list/detail ideology layout.
--}}
            [
                'slug' => 'liberalism',
                'title' => 'Liberalism',
                'content' => 'Liberalism adalah ideologi yang menekankan kebebasan individu, supremasi hukum, dan perlindungan hak asasi manusia...'
            ],
            [
                'slug' => 'conservatism',
                'title' => 'Conservatism',
                'content' => 'Konservatisme berfokus pada pelestarian nilai-nilai tradisional, stabilitas sosial, dan kehati-hatian terhadap perubahan drastis...'
            ],
            [
                'slug' => 'marxism',
                'title' => 'Marxism',
                'content' => 'Marxisme adalah teori politik dan ekonomi yang didasarkan pada pemikiran Karl Marx, terutama mengenai perjuangan kelas...'
            ],
            [
                'slug' => 'socialism',
                'title' => 'Socialism',
                'content' => 'Sosialisme menekankan kepemilikan bersama dalam pengelolaan sumber daya demi kesejahteraan kolektif...'
            ],
            [
                'slug' => 'communism',
                'title' => 'Communism',
                'content' => 'Komunisme adalah bentuk ekstrem sosialisme yang menargetkan masyarakat tanpa kelas dan tanpa negara...'
            ],
            [
                'slug' => 'fascism',
                'title' => 'Fascism',
                'content' => 'Fasisme adalah ideologi otoriter nasionalis yang menolak demokrasi dan mengutamakan negara di atas individu...'
            ],
            [
                'slug' => 'anarchism',
                'title' => 'Anarchism',
                'content' => 'Anarkisme menolak konsep negara dan struktur kekuasaan hierarkis, mengutamakan kebebasan sepenuhnya...'
            ],
            [
                'slug' => 'nationalism',
                'title' => 'Nationalism',
                'content' => 'Nasionalisme menempatkan identitas dan kepentingan bangsa sebagai prioritas utama...'
            ],
            [
                'slug' => 'environmentalism',
                'title' => 'Environmentalism',
                'content' => 'Ideologi yang fokus pada keberlanjutan, pelestarian lingkungan, dan mitigasi kerusakan ekologis...'
            ],
            [
                'slug' => 'libertarianism',
                'title' => 'Libertarianism',
                'content' => 'Libertarianisme menekankan kebebasan individu secara ekstrem dan meminimalkan intervensi negara...'
            ],
            [
                'slug' => 'monarchy',
                'title' => 'Monarchy',
                'content' => 'Monarki adalah sistem pemerintahan yang dipimpin oleh raja atau ratu sebagai kepala negara...'
            ],
            [
                'slug' => 'republic',
                'title' => 'Republic',
                'content' => 'Republik mengedepankan sistem pemerintahan berbasis perwakilan rakyat...'
            ],
            [
                'slug' => 'democracy',
                'title' => 'Democracy',
                'content' => 'Demokrasi adalah sistem pemerintahan di mana kekuasaan berada pada rakyat...'
            ],
            [
                'slug' => 'theocracy',
                'title' => 'Theocracy',
                'content' => 'Teokrasi adalah pemerintahan yang didasarkan pada prinsip, hukum, atau otoritas agama...'
            ],
            [
                'slug' => 'oligarchy',
                'title' => 'Oligarchy',
                'content' => 'Oligarki menempatkan kekuasaan pada kelompok kecil elit yang berpengaruh...'
            ],
            [
                'slug' => 'authoritarianism',
                'title' => 'Authoritarianism',
                'content' => 'Otoritarianisme membatasi kebebasan individu dan memusatkan kekuasaan pada otoritas tunggal...'
            ],
            [
                'slug' => 'totalitarianism',
                'title' => 'Totalitarianism',
                'content' => 'Totalitarianisme adalah bentuk paling ekstrem otoritarianisme di mana negara mengontrol seluruh aspek kehidupan...'
            ],
            [
                'slug' => 'technocracy',
                'title' => 'Technocracy',
                'content' => 'Teknokrasi adalah sistem pemerintahan yang dijalankan oleh para ahli dan teknolog, bukan politisi...'
            ],
        ]);

        $ideology = $items->firstWhere('slug', $slug);

        if (!$ideology) {
            abort(404); // jika slug tidak ada
        }

{{-- End of file --}}
 