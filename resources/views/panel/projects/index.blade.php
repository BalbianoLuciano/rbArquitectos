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
                <a href="{{ route('panel.projects.create') }}" class="btn btn-primary">Create Project <i class="bi bi-plus-circle ml-2"></i></a>
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
                    @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->start }}</td>
                            <td>{{ $project->end }}</td>
                            <td>
                                <a href="{{ route('panel.projects.edit', $project) }}" class="btn btn-warning">Edit<i class="bi bi-pencil ml-2"></i></a>
                                <a href="{{ route('panel.projects.show', $project) }}" class="btn btn-info">show <i class="bi bi-eye ml-2"></i></a>
                                <form action="{{ route('panel.projects.destroy', $project) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete <i class="bi bi-trash ml-2"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No projects found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $projects->links() }}
        </div>
    </div>
@stop
