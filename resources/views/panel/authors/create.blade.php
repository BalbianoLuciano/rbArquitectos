@extends('layouts.admin')

@section('content')
    <h1>Create Author</h1>
    <form action="{{ route('panel.authors.store') }}" method="POST">
        @csrf
        @include('panel.authors.form', ['buttonText' => 'Create Author'])
    </form>
@endsection
