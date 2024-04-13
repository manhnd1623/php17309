@extends('layouts.master')

@section('content')
    <h1>Cập nhật danh mục: {{ $product->name }}</h1>

    @if(\Session::has('msg'))
        <div class="alert alert-success">
            {{ \Session::get('msg') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">

        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">

        <label for="price_sale">Price sale</label>
        <input type="text" class="form-control" name="price_sale" id="price_sale" value="{{ $product->price_sale }}">

        <label for="img">Img</label>
        <input type="file" class="form-control" name="img" id="img">
        <img src="{{ \Storage::url($product->img) }}" alt="" width="50px">


        <label for="is_active">IsActive</label>

        <input type="radio" value="{{ \App\Models\product::ACTIVE }}"
               @if($product->is_active == \App\Models\product::ACTIVE) checked @endif
               name="is_active" id="is_active-1">
        <label for="is_active-1">Active</label>

        <input type="radio" value="{{ \App\Models\product::INACTIVE }}"
               @if($product->is_active == \App\Models\product::INACTIVE) checked @endif
               name="is_active" id="is_active-2">
        <label for="is_active-2">InActive</label>

        <br>

        <label for="describe">Describe</label>
        <textarea class="form-control" name="describe" id="describe">{{ $product->describe }}</textarea>

        <br><br>
        <a href="{{ route('products.index') }}" class="btn btn-info">Quay lại  danh sách</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection