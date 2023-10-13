@extends('layouts.admin')

@section('content')
    <h1>Edit Author</h1>
    <form action="{{ route('panel.authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')
        @include('panel.authors.form', ['buttonText' => 'Update Author'])
    </form>
@endsection
