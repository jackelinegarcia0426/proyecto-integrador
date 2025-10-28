@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-medium">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="mt-2 text-gray-600">Has iniciado sesión correctamente.</p>
    </div>
</div>
@endsection
