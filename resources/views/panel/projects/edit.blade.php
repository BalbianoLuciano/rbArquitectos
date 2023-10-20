@extends('layouts.admin')

@section('content')
    <h1>Edit Project</h1>
    <form action="{{ route('panel.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('panel.projects.form', ['buttonText' => 'Update Project'])
    </form>
@endsection
