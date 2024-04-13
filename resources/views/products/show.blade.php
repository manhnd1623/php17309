@extends('layouts.master')

@section('content')
    <h1>Xem chi tiết: {{ $product->name }}</h1>

    <ul>
        <li>ID: {{ $product->id }}</li>
        <li>Name: {{ $product->name }}</li>
        <li>Price: {{ $product->price }}</li>
        <li>Price sale: {{ $product->price }}</li>
        <li>Img: <img src="{{ \Storage::url($product->img) }}" alt="" width="50px"> </li>
        <li>IsActive: {{ $product->is_active ? 'Active' : 'InActive' }}</li>
        <li>Describe: {{ $product->describe }}</li>
    </ul>

    <a href="{{ route('products.index') }}" class="btn btn-info">Quay lại  danh sách</a>
@endsection