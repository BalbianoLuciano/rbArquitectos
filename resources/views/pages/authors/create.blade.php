@extends('layouts.admin')

@section('content')
    <h1>Create Author</h1>
    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <textarea class="form-control" id="biography" name="biography" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Author</button>
    </form>
@endsection
