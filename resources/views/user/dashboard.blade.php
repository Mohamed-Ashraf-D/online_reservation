@extends('layouts.user')

@section('content')
    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <p>Use the sidebar to browse services or view your reservations.</p>
@endsection
