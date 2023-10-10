@extends('layouts.admin')

@section('title', 'Companies List')

@section('content_header')
    <h1>Companies List</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Companies</h3>
            <div class="card-tools">
                <a href="{{ route('companies.create') }}" class="btn btn-primary">Create Company</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr class="table-header">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Direction</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->direction }}</td>
                            <td>{{ Str::limit($company->description, 50) }}</td>
                            <td>
                                <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('companies.show', $company) }}" class="btn btn-info">Show</a>
                                <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $companies->links() }}
        </div>
    </div>
@stop
