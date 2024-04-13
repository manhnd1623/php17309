@extends('layouts.master')

@section('content')
    <h1>Cập nhật danh mục: {{ $car->name }}</h1>

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

    <form action="{{ route('cars.update', $car) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $car->name }}">

        <label for="brand">Brand</label>
        <input type="text" class="form-control" name="brand" id="brand" value="{{ $car->brand }}">

        <label for="img">Img</label>
        <input type="file" class="form-control" name="img" id="img">
        <img src="{{ \Storage::url($car->img) }}" alt="" width="50px">

        <br>
        <label for="is_active">IsActive</label>

        <input type="radio" value="{{ \App\Models\car::ACTIVE }}"
               @if($car->is_active == \App\Models\car::ACTIVE) checked @endif
               name="is_active" id="is_active-1">
        <label for="is_active-1">Active</label>

        <input type="radio" value="{{ \App\Models\car::INACTIVE }}"
               @if($car->is_active == \App\Models\car::INACTIVE) checked @endif
               name="is_active" id="is_active-2">
        <label for="is_active-2">InActive</label>
<br>
        <label for="describe">Describe</label>
        <textarea class="form-control" name="describe" id="describe">{{ $car->describe }}</textarea>

        <br><br>
        <a href="{{ route('cars.index') }}" class="btn btn-info">Quay lại  danh sách</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection