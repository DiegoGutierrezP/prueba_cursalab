@extends('layouts.app')

@section('header')
    <header class="bg-gray-700 flex items-center justify-between px-4 lg:px-48 xl:px-96 py-4">
        <h2 class="text-2xl font-medium text-violet-600">UDEMYX</h2>
        <nav class="flex items-center justify-between">
            <a href="">ada</a>
            <a href="">asd</a>
            <a href="">asda</a>
        </nav>
    </header>
@endsection

@section('content')
    <div class="h-full w-full px-4 lg:px-48 xl:px-96 py-10">
        @yield('content2')
    </div>
@endsection
