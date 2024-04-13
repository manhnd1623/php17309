<?php

namespace App\Http\Controllers;

use App\Models\device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class deviceController extends Controller
{
    const PATH_VIEW = 'devices.';
    const PATH_UPLOAD = 'devices';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = device::query()->latest('id')->paginate(5);

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
            'name' => 'required|max:100',
            'serial' => 'required|max:100|unique:devices',
            'model' => 'required|max:100',
            'img' => 'nullable|image|max:2048',
            'is_active' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    Device::ACTIVE,
                    Device::INACTIVE
                ])
            ],
            'describe' => 'nullable|max:500',

        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        Device::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('device'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => [
                'required',
                'max:100',
            ],
            'serial' => [
                'required',
                'max:100',
                \Illuminate\Validation\Rule::unique('devices')->ignore($device->id)
            ],
            'model' => [
                'required',
                'max:100',
            ],
            'img' => 'nullable|image|max:2048',
            'is_active' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    device::ACTIVE,
                    device::INACTIVE
                ])
            ],
            'describe' => 'nullable|max:500',
        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        $oldPathImg = $device->img;

        $device->update($data);

        if ($request->hasFile('img') && Storage::exists($device->img)) {
            Storage::delete($oldPathImg);
        }

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();

        if (Storage::exists($device->img)) {
            Storage::delete($device->img);
        }

        return back()->with('msg', 'Thao tác thành công');
    }
}