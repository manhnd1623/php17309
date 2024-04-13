@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm mới Airline</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">

                @if(\Session::has('msg'))
                    <div class="alert alert-success">
                        {{ \Session::get('msg') }}
                    </div>
                @endif

                <form action="{{ route('admin.airlines.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name">

                    <label for="img" class="mt-3">Img</label>
                    <input type="file" name="img" class="form-control" id="img">

                    <label for="is_show" class="mt-3">Is Show</label> <br>

                    <input type="radio" name="is_show" id="is_show-1"
                           value="{{ \App\Models\Airline::SHOW }}">
                    <label for="is_show-1">SHOW</label>

                    <input type="radio" name="is_show" id="is_show-2"
                           value="{{ \App\Models\Airline::INSHOW }}">
                    <label for="is_show-2">HIDE</label>

                    <br>
                    <a href="{{ route('admin.airlines.index') }}" class="btn btn-info mt-3">Trang danh sách</a>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection