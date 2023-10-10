@extends('layouts.admin')

@section('title', 'Projects List')

@section('content_header')
    <h1>Projects List</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Projects</h3>
            <div class="card-tools">
                <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr class="table-header">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->start }}</td>
                            <td>{{ $project->end }}</td>
                            <td>
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-info">show</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
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
            {{ $projects->links() }}
        </div>
    </div>
@stop
