@extends('layouts.admin')

@section('content')
    <h1>Create Company</h1>
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        @include('pages.companies.form', ['buttonText' => 'Create Company'])
    </form>
@endsection
