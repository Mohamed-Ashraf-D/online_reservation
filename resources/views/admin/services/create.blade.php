@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Add New Service</h2>

        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input name="price" type="number" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Available</label>
                <select name="is_available" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button class="btn btn-success">Create</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
