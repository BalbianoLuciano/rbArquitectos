@extends('layouts.admin')

@section('content')
    <h1>Edit Company</h1>
    <form action="{{ route('panel.companies.update', $company) }}" method="POST">
        @csrf
        @method('PUT')
        @include('panel.companies.form', ['buttonText' => 'Update Company'])
    </form>
@endsection
