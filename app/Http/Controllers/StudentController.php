<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(12);
        return view('mentor.students.index', compact('students'));
    }

    public function create()
    {
        return view('mentor.students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'class_year' => 'nullable|string|max:255',
            'major_interest' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/students');
            $data['photo'] = Storage::url($path);
        }

        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Student $student)
    {
        return view('mentor.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'class_year' => 'nullable|string|max:255',
            'major_interest' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/students');
            $data['photo'] = Storage::url($path);
        }

        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        // optionally delete existing photo
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
