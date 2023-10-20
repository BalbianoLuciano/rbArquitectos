@extends('layouts.admin')

@section('title', 'Authors List')

@section('content_header')
    <h1>Authors List</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Authors</h3>
            <div class="card-tools">
                <a href="{{ route('panel.authors.create') }}" class="btn btn-primary">Create Author</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr class="table-header">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Profile Picture</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $author)
                        <tr>
                            <td class="text-center align-middle">{{ $author->author_id }}</td>
                            <td class="text-center align-middle">{{ $author->name }}</td>
                            <td class="text-center align-middle"><img src="{{ $author->getFirstMediaUrl('image') }}" alt="{{ $author->name }}" width="80" height="80"></td>
                            <td class="text-center align-middle">
                                <a href="{{ route('panel.authors.edit', $author) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('panel.authors.show', $author) }}" class="btn btn-info">show</a>
                                <form action="{{ route('panel.authors.destroy', $author) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No authors found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $authors->links() }}
        </div>
        <!-- card-footer -->
    </div>
    <!-- /.card -->
@stop
