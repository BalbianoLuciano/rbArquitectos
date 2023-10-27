@extends('layouts.admin')

@section('content')
<h1 class="">{{ $company->name }}</h1>
    <div class="card">
        <div class="card-body">
            <p class="font-weight-bold text-secondary">Direction: <span class="text-normal">{{ $company->direction }}</span></p>
            <p class="font-italic">{{ $company->description }}</p>
    
            <h2 class="mt-4">Projects</h2>
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr class="table-header">
                            <th>Project Name</th>
                            <th>Role</th>
                            <th>Update</th>
                            <th>Project Duration</th>
                            <th>Colaboration Start</th>
                            <th>Colaboration End</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company->projects as $project)
                            <tr>
                                <td><a href="{{route('panel.projects.show', $project->id)}}">{{ $project->name }}</a></td>
                                <td><span class="badge bg-primary"><i class="bi bi-tools pr-2"></i>{{ $project->pivot->company_role }}</span></td>
                                <td>{{ $project->pivot->project_update }}</td>
                                <td>{{ $project->start }} - {{ $project->end }}</td>
                                <td>{{ $project->pivot->start }}</td>
                                <td>{{ $project->pivot->end }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <div class="mt-4">
                <a href="{{ route('panel.companies.edit', $company) }}" class="btn btn-warning">Edit <i class="bi bi-pencil pl-2"></i></a>
                <form action="{{ route('panel.companies.destroy', $company) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" data-message="Eliminar a esta compañía '{{ $company->name }}'" role="confirm">Delete <i class="bi bi-trash pl-2"></i></button>
                </form>
                <a href="{{ route('panel.companies.index') }}" class="btn btn-secondary">Go back <i class="bi bi-arrow-left-circle pl-2"></i></a>
            </div>
        </div>
    </div>
@endsection
