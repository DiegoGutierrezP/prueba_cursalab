@extends('layouts.app')

@section('header')
    <header-component></header-component>
@endsection

@section('content')
    <div class="h-full w-full px-4 lg:px-32 xl:px-72 py-10">
        @yield('content2')
    </div>
@endsection
