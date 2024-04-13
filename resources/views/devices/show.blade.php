@extends('layouts.master')

@section('content')
    <h1>Xem chi tiết: {{ $devices->name }}</h1>

    <ul>
        <li>ID: {{ $device->id }}</li>
        <li>Name: {{ $device->name }}</li>
        <li>Serial: {{ $device->serial }}</li>
        <li>Model: {{ $device->model }}</li>
        <li>Img: <img src="{{ \Storage::url($device->img) }}" alt="" width="50px"> </li>
        <li>IsActive: {{ $device->is_active ? 'Active' : 'InActive' }}</li>
        <li>Describe: {{ $device->describe }}</li>

    </ul>

    <a href="{{ route('devices.index') }}" class="btn btn-info">Quay lại  danh sách</a>
@endsection