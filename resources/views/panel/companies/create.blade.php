@extends('layouts.admin')

@section('content')
    <h1 class="py-3">Create Company</h1>
    <form action="{{ route('panel.companies.store') }}" method="POST">
        @csrf
        @include('panel.companies.form', ['buttonText' => 'Create Company'])
    </form>
@endsection
