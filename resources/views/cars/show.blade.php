@extends('layouts.master')

@section('content')
    <h1>Xem chi tiết: {{ $car->name }}</h1>

    <ul>
        <li>ID: {{ $car->id }}</li>
        <li>Name: {{ $car->name }}</li>
        <li>Brand: {{ $car->brand }}</li>
        <li>Img: <img src="{{ \Storage::url($car->img) }}" alt="" width="50px"> </li>
        <li>IsActive: {{ $car->is_active ? 'Active' : 'InActive' }}</li>
        <li>Describe: {{ $car->describe }}</li>

    </ul>

    <a href="{{ route('cars.index') }}" class="btn btn-info">Quay lại  danh sách</a>
@endsection