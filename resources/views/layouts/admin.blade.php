@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@push('css')
    <!-- Tus estilos CSS adicionales específicos para el admin aquí -->
    @vite('resources/css/app.css')
@endpush

@section('content')
    <div>
        @yield('admin-content')
    </div>
@stop

@push('js')
    <!-- Tus scripts JS adicionales específicos para el admin aquí -->
    @vite('resources/js/app.js')
@endpush
