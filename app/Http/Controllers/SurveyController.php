<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function create()
    {
        return view('survey.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'topic_interest' => 'nullable|string|max:255',
            'reason' => 'nullable|string',
            'expected_impact' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        Survey::create($data);

        return redirect()->route('survey.create')->with('success', 'Terima kasih, tanggapanmu telah tersimpan.');
    }
}
