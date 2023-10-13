@extends('layouts.admin')

@section('content')
    <h1>Create Project</h1>
    <form action="{{ route('panel.projects.store') }}" method="POST">
        @csrf
        @include('panel.projects.form', ['buttonText' => 'Create Project'])
    </form>
@endsection
