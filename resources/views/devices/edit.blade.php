@extends('layouts.master')

@section('content')
    <h1>Cập nhật danh mục: {{ $device->name }}</h1>

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

    <form action="{{ route('devices.update', $device) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $device->name }}">

        <label for="serial">Serial</label>
        <input type="text" class="form-control" name="serial" id="serial" value="{{ $device->serial }}">

        <label for="model">Model</label>
        <input type="text" class="form-control" name="model" id="model" value="{{ $device->model }}">

        <label for="img">Img</label>
        <input type="file" class="form-control" name="img" id="img">
        <img src="{{ \Storage::url($device->img) }}" alt="" width="50px">

        

        <label for="is_active">IsActive</label>

        <input type="radio" value="{{ \App\Models\Device::ACTIVE }}"
               @if($device->is_active == \App\Models\Device::ACTIVE) checked @endif
               name="is_active" id="is_active-1">
        <label for="is_active-1">Active</label>

        <input type="radio" value="{{ \App\Models\Device::INACTIVE }}"
               @if($device->is_active == \App\Models\Device::INACTIVE) checked @endif
               name="is_active" id="is_active-2">
        <label for="is_active-2">InActive</label>

        <br>
        <label for="describe">Describe</label>
        <textarea class="form-control" name="describe" id="describe">{{ $device->describe }}</textarea>

        <br><br>
        <a href="{{ route('devices.index') }}" class="btn btn-info">Quay lại  danh sách</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection