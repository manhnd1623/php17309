@extends('layouts.master')

@section('content')
    <h1>Xem chi tiết: {{ $student->name }}</h1>

    <ul>
        <li>ID: {{ $student->id }}</li>
        <li>Name: {{ $student->name }}</li>
        <li>Code: {{ $student->code }}</li>
        <li>Ngay sinh: {{ $student->date_of_birth }}</li>
        <li>Img: <img src="{{ \Storage::url($student->img) }}" alt="" width="50px"> </li>
        <li>IsActive: {{ $student->is_active ? 'Active' : 'InActive' }}</li>
    </ul>

    <a href="{{ route('students.index') }}" class="btn btn-info">Quay lại  danh sách</a>
@endsection