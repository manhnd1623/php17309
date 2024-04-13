@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh sách Flight</h1>

            <a href="{{ route('admin.flights.create') }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Add</a>
        </div>

        <!-- Content Row -->

        @if(\Session::has('msg'))
            <div class="alert alert-success">
                {{ \Session::get('msg') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tr>
                            <th>ID</th>
                            <th>Number</th>
                            <th>Image</th>
                            <th>Khach hang</th>
                            <th>May bay</th>
                            <th>Action</th>
                        </tr>

                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->number }}</td>
                                <td>
                                    <img src="{{ \Storage::url($item->image) }}" alt="" width="100px">
                                </td>
                                <td>{{ $item->total_passengers }}</td>
                                <td>{{ $item->airline->id . ' - ' . $item->airline->name }}</td>
                                <td>
                                    <a href="{{ route('admin.flights.edit', $item) }}" class="btn btn-info mt-2">Edit</a>

                                    <form action="{{ route('admin.flights.destroy', $item) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger mt-2"
                                                onclick="return confirm('Có chắc xóa không?')">Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $data->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection