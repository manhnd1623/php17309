@extends('layouts.master')

@section('content')
    <h1>Cập nhật danh mục: {{ $student->name }}</h1>

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

    <form action="{{ route('students.update', $student) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $student->name }}">

        <label for="code">Code</label>
        <input type="text" class="form-control" name="code" id="code" value="{{ $student->code }}">

        <label for="date_of_birth">Ngay sinh</label>
        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ $student->date_of_birth }}">

        <label for="img">Img</label>
        <input type="file" class="form-control" name="img" id="img">
        <img src="{{ \Storage::url($student->img) }}" alt="" width="50px">

        <label for="excerpt">Excerpt</label>
        <textarea class="form-control" name="excerpt" id="excerpt">{{ $student->excerpt }}</textarea>

        <label for="is_active">IsActive</label>

        <input type="radio" value="{{ \App\Models\student::ACTIVE }}"
               @if($student->is_active == \App\Models\student::ACTIVE) checked @endif
               name="is_active" id="is_active-1">
        <label for="is_active-1">Active</label>

        <input type="radio" value="{{ \App\Models\student::INACTIVE }}"
               @if($student->is_active == \App\Models\student::INACTIVE) checked @endif
               name="is_active" id="is_active-2">
        <label for="is_active-2">InActive</label>

        <br><br>
        <a href="{{ route('students.index') }}" class="btn btn-info">Quay lại  danh sách</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection