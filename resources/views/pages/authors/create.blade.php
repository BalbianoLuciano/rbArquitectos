@extends('layouts.admin')

@section('content')
    <h1>Create Author</h1>
    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        @include('pages.authors.form', ['buttonText' => 'Create Author'])
    </form>
@endsection
