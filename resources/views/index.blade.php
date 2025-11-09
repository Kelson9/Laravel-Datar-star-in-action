@extends('layouts.app')

@section('content')

@auth
    <p class="text-center text-lg mb-4">I, <span class="font-bold">{{ auth()->user()->name }}</span> is authenticated</p>
@endauth

@guest
    <p class="text-center text-lg mb-4">No user authenticated</p>
@endguest

<div class="min-h-screen w-full flex justify-center items-center gap-10">
    @auth
        <a class="btn btn-primary" href="{{ route('tasks') }}" data-navigate="true">Tasks</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @endauth

    @guest
        <a class="btn btn-primary" href="{{ route('auth.login-view') }}" data-navigate="true">Login</a>
        <a class="btn btn-warning" href="{{ route('auth.register-view') }}" data-navigate="true">Register</a>
    @endguest
</div>
@endsection()