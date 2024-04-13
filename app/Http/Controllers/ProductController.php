<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    const PATH_VIEW = 'products.';
    const PATH_UPLOAD = 'products';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = product::query()->latest('id')->paginate(5);

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
            'name' => 'required|max:100|unique:products',
            'price' => 'required|max:100',
            'price_sale' => 'required|max:100|unique:products',
            'img' => 'nullable|image|max:2048',
            'is_active' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    product::ACTIVE,
                    product::INACTIVE
                ])
            ],
            'describe' => 'nullable|max:500',

        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        product::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'name' => [
                'required',
                'max:100',
                \Illuminate\Validation\Rule::unique('products')->ignore($product->id)
            ],
            'price' => [
                'required',
                'max:100',
            ],
            'price_sale' => [
                'required',
                'max:100',
                \Illuminate\Validation\Rule::unique('products')->ignore($product->id)
            ],
            'img' => 'nullable|image|max:2048',
            'is_active' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    product::ACTIVE,
                    product::INACTIVE
                ])
            ],
            'describe' => 'nullable|max:500',

        ]);

        $data = $request->except(['img']);

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        $oldPathImg = $product->img;

        $product->update($data);

        if ($request->hasFile('img') && Storage::exists($product->img)) {
            Storage::delete($oldPathImg);
        }

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();

        if (Storage::exists($product->img)) {
            Storage::delete($product->img);
        }

        return back()->with('msg', 'Thao tác thành công');
    }
}