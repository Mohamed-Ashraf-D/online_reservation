@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Admin List</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary mb-3">Add New Admin</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
            </tr>
            </thead>
            <tbody>
            @forelse($admins as $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @foreach($admin->roles as $role)
                            <span class="badge bg-info">{{ $role->name }}</span>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No admins found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
