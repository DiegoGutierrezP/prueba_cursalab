@extends('layouts.layout-home')

@section('content2')
    <div class="min-h-screen" >
        <a href="{{route('home')}}" class="p-2 bg-blue-400 mb-3 rounded-lg hover:bg-blue-600">Mis cursos</a>
        <br><br>
            <show-curso></show-curso>
    </div>
@endsection
