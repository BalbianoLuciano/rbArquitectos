@extends('layouts.admin')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>Start: {{ $project->start }}</p>
    <p>End: {{ $project->end }}</p>
    <!-- ... Display other project details as needed ... -->
    <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
