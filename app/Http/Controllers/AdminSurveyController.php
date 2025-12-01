<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class AdminSurveyController extends Controller
{
    public function index()
    {
        // fetch surveys from DB and return to admin view
        $surveys = Survey::orderBy('created_at', 'desc')->get();
        return view('admin.surveys.index', compact('surveys'));
    }

    public function destroy($id)
    {
        $s = Survey::find($id);
        if ($s) {
            $s->delete();
            return redirect()->route('admin.surveys.index')->with('success', 'Survey dihapus');
        }
        return redirect()->route('admin.surveys.index')->with('error', 'Survey tidak ditemukan');
    }
}
