@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Service</h2>

        <form method="POST" action="{{ route('admin.services.update', $service) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" value="{{ $service->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required>{{ $service->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input name="price" type="number" step="0.01" value="{{ $service->price }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Available</label>
                <select name="is_available" class="form-control" required>
                    <option value="1" {{ $service->is_available ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$service->is_available ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
