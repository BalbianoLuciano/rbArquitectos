@extends('layouts.admin')

@section('content')
    <h1>{{ $author->name }}</h1>
    
    @if($author->hasMedia('image'))
        <img src="{{ $author->getFirstMediaUrl('image') }}" alt="{{ $author->name }}">
    @endif
    
    <p>{{ $author->biography }}</p>
    <a href="{{ route('panel.authors.edit', $author) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('panel.authors.destroy', $author) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
