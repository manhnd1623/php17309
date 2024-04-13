@extends('layouts.master')

@section('content')
    <h1>Thêm mới danh mục</h1>

    @if(\Session::has('msg'))
        <div class="alert alert-danger">
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

    <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name">

        <label for="code">Code</label>
        <input type="text" class="form-control" name="code" id="code">

        <label for="date_of_birth">Ngay sinh</label>
        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth">

        <label for="img">Img</label>
        <input type="file" class="form-control" name="img" id="img">

        <label for="is_active">IsActive</label>

        <input type="radio" value="{{ \App\Models\student::ACTIVE }}" name="is_active" id="is_active-1">
        <label for="is_active-1">Active</label>

        <input type="radio" value="{{ \App\Models\student::INACTIVE }}" name="is_active" id="is_active-2">
        <label for="is_active-2">InActive</label>

        <br><br>
        <a href="{{ route('students.index') }}" class="btn btn-info">Quay lại  danh sách</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection