@extends('layouts.admin')

@section('content')
    <h1>Edit Company</h1>
    <form action="{{ route('companies.update', $company) }}" method="POST">
        @csrf
        @method('PUT')
        @include('pages.companies.form', ['buttonText' => 'Update Company'])
    </form>
@endsection
