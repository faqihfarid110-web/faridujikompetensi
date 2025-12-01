<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FunfactFeedback;

class FunfactFeedbackController extends Controller
{
    public function store(Request $request, $slug)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:2000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $data['slug'] = $slug;

        $fb = FunfactFeedback::create($data);

        // Recalculate average and count
        $feedbacks = FunfactFeedback::where('slug', $slug)->get();
        $avg = $feedbacks->avg('rating') ?: null;
        $count = $feedbacks->count();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Terima kasih — komentar dan penilaianmu sudah direkam.',
                'feedback' => $fb,
                'average' => $avg,
                'count' => $count,
            ]);
        }

        return redirect()->back()->with('success', 'Terima kasih — komentar dan penilaianmu sudah direkam.');
    }
}
