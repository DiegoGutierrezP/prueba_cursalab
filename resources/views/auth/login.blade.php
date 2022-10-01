@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-3">
        <form-login register-route="{{ route('register') }}" ></form-login>
    </div>
@endsection
