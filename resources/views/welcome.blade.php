@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-eOJFj2chUpjA5Q3WM5/FE4X8ZcLBCSg6uM6V5J1XfzkjiP4N7ER+/r27C3z4jzzK" crossorigin="anonymous"></script>
    <script> console.log('Hi!'); </script>
@stop
