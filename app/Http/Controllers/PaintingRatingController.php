<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaintingRatingController extends Controller
{
    /** Store rating and optional comment for a painting (slug) */
    public function store(Request $request, $slug)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $dir = storage_path('app/ratings');
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $file = $dir.'/'.Str::slug($slug).'.json';
        $entry = [
            'rating' => (int) $data['rating'],
            'comment' => $data['comment'] ?? '',
            'time' => now()->toDateTimeString(),
            'ip' => $request->ip(),
        ];
        $payload = ['ratings' => []];
        if (file_exists($file)) {
            $payload = json_decode(file_get_contents($file), true) ?: ['ratings' => []];
        }
        $payload['ratings'][] = $entry;
        file_put_contents($file, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // return aggregated stats
        $avg = 0;
        $count = count($payload['ratings']);
        if ($count > 0) {
            $avg = round(array_sum(array_column($payload['ratings'], 'rating')) / $count, 2);
        }
        return response()->json(['success' => true, 'avg' => $avg, 'count' => $count]);
    }

    /** Return rating stats for a painting */
    public function stats($slug) {
        $file = storage_path('app/ratings/'.Str::slug($slug).'.json');
        if (!file_exists($file)) {
            return response()->json(['avg' => 0, 'count' => 0, 'ratings' => []]);
        }
        $payload = json_decode(file_get_contents($file), true) ?: ['ratings' => []];
        $count = count($payload['ratings']);
        $avg = 0;
        if ($count > 0) $avg = round(array_sum(array_column($payload['ratings'], 'rating')) / $count, 2);
        return response()->json(['avg' => $avg, 'count' => $count, 'ratings' => $payload['ratings']]);
    }
}
