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
                <a href="{{ route('panel.companies.create') }}" class="btn btn-primary">
                    Create Company <i class="bi bi-plus-circle ml-2"></i>
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr class="table-header text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Direction</th>
                        <th>Description</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->direction }}</td>
                            <td>{{ Str::limit($company->description, 50) }}</td>
                            <td class="text-center align-middle">
                                <img src="{{ $company->getFirstMediaUrl('image') }}" alt="{{ $company->name }}" width="80" height="80">
                            </td>
                            <td>
                                <a href="{{ route('panel.companies.edit', $company) }}" class="btn btn-warning">
                                    Edit <i class="bi bi-pencil ml-2"></i>
                                </a>
                                <a href="{{ route('panel.companies.show', $company) }}" class="btn btn-info">
                                    Show <i class="bi bi-eye ml-2"></i>
                                </a>
                                <form action="{{ route('panel.companies.destroy', $company) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Delete <i class="bi bi-trash ml-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No companies found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $companies->links() }}
        </div>
    </div>
@stop
