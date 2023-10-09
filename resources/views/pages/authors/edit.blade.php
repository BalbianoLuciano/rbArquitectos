@extends('layouts.admin')

@section('content')
    <h1>Edit Author</h1>
    <form action="{{ route('authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $author->name }}" required>
        </div>
        <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <textarea class="form-control" id="biography" name="biography" required>{{ $author->biography }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Author</button>
    </form>
@endsection
