
@extends('layouts.admin')

@section('content')
<h1>welcome to admin panel</h1>
<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">logout</button>
</form>
@endsection
