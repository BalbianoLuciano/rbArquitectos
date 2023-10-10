@extends('layouts.admin')

@section('content')
    <h1>Create Project</h1>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        @include('pages.projects.form', ['buttonText' => 'Create Project'])
    </form>
@endsection
