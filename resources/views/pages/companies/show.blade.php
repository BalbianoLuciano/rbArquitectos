@extends('layouts.admin')

@section('content')
    <h1>{{ $company->name }}</h1>
    <p>Direction: {{ $company->direction }}</p>
    <p>Description: {{ $company->description }}</p>
    
    <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
