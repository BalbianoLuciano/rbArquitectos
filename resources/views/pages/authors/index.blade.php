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
                <a href="{{ route('authors.create') }}" class="btn btn-primary">Create Author</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr class="table-header">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td>{{ $author->author_id }}</td>
                            <td>{{ $author->name }}</td>
                            <td>
                                <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('authors.show', $author) }}" class="btn btn-info">show</a>
                                <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline;">
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
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $authors->links() }}
        </div>
        <!-- card-footer -->
    </div>
    <!-- /.card -->
@stop
