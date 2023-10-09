@extends('layouts.admin')

@section('content')
    <h1>{{ $author->name }}</h1>
    <p>{{ $author->biography }}</p>
    <a href="{{ route('authors.edit', $author) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
