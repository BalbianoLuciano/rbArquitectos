@extends('layouts.admin')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>Start: {{ $project->start }}</p>
    <p>End: {{ $project->end }}</p>
    @foreach ($project->authors as $author)
        <p>{{ $author->name }}</p>
    @endforeach
    <p>{{$project->companies}}</p>
    <ul>
        @foreach($project->companies as $company)
            <li>
                <strong>{{ $company->name }}</strong> 
                - Description: {{ $company->pivot->description }}
                - Role: {{ $company->pivot->company_role }}
                - Update: {{ $company->pivot->project_update }}
                - Start: {{ $company->pivot->start }}
                - End: {{ $company->pivot->end }}
            </li>
        @endforeach
    </ul>


    <!-- ... Display other project details as needed ... -->
    <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
