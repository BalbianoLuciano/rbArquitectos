@extends('layouts.admin')

@section('content')
    <h1>Edit Project</h1>
    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        @include('pages.projects.form', ['buttonText' => 'Update Project'])
    </form>
@endsection
