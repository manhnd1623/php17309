<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    const PATH_VIEW = 'cars.';
    const PATH_UPLOAD = 'cars';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Car::query()->latest('id')->paginate(5);

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
            'name' => 'required|max:100|unique:cars',
            'brand' => 'required|max:100',
            'img' => 'nullable|image|max:2048',
            'is_active' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    Car::ACTIVE,
                    Car::INACTIVE
                ])
            ],
            'describe' => 'nullable|max:500',

        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        Car::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => [
                'required',
                'max:100',
                \Illuminate\Validation\Rule::unique('cars')->ignore($car->id)
            ],
            'brand' => [
                'required',
                'max:100',
            ],
            'img' => 'nullable|image|max:2048',
            'is_active' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    Car::ACTIVE,
                    Car::INACTIVE
                ])
            ],
            'describe' => 'nullable|max:500',

        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        $oldPathImg = $car->img;

        $car->update($data);

        if ($request->hasFile('img') && Storage::exists($car->img)) {
            Storage::delete($oldPathImg);
        }

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        if (Storage::exists($car->img)) {
            Storage::delete($car->img);
        }

        return back()->with('msg', 'Thao tác thành công');
    }
}