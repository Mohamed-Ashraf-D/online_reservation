@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Service List</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Add New Service</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price ($)</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->price }}</td>
                    <td>{{ $service->is_available ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
