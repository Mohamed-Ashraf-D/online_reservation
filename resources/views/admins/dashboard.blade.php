@extends('layouts.admins')

@section('content')
    <h1>welcome to admin panel</h1>
    <form method="POST" action="{{ route('admins.logout') }}">
        @csrf
        <button type="submit">logout</button>
    </form>
@endsection
