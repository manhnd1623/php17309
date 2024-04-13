<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class studentController extends Controller
{
    const PATH_VIEW = 'students.';
    const PATH_UPLOAD = 'students';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = student::query()->latest('id')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:students', 
            'code' => 'required|max:10|unique:students',
            'date_of_birth' => 'nullable|date|max:2048',
            'img' => 'nullable|image|max:2048',
            'is_active' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    student::ACTIVE,
                    student::INACTIVE
                ])
            ],
        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        student::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student)
    {
        $request->validate([
            'name' => [
                'required',
                'max:100',
                \Illuminate\Validation\Rule::unique('students')->ignore($student->id)
            ],
            'code' => [
                'required',
                'max:10',
                \Illuminate\Validation\Rule::unique('students')->ignore($student->id)
            ],
            'date_of_birth' => 'nullable|date|max:2048',
            'img' => 'nullable|image|max:2048',
            'excerpt' => 'nullable|max:500',
            'is_active' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    student::ACTIVE,
                    student::INACTIVE
                ])
            ],
        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        $oldPathImg = $student->img;

        $student->update($data);

        if ($request->hasFile('img') && Storage::exists($student->img)) {
            Storage::delete($oldPathImg);
        }

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        $student->delete();

        if (Storage::exists($student->img)) {
            Storage::delete($student->img);
        }

        return back()->with('msg', 'Thao tác thành công');
    }
}