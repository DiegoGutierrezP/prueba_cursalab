@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-3">
        <form-register login-route="{{ route('login') }}" ></form-register>
    </div>
@endsection
