@extends('layouts.admin')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>Start: {{ $project->start }}</p>
    <p>End: {{ $project->end }}</p>
    @foreach ($project->authors as $author)
        <p>{{ $author->name }}</p>
    @endforeach

    <div>
        <h3>Project Images:</h3>
        @foreach($project->getMedia('projects') as $media) <!-- 'projects' es el nombre de la colección -->
            <img src="{{ $media->getUrl() }}" alt="{{ $project->name }}" style="max-width: 300px; max-height: 200px;">
        @endforeach
    </div>

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
    <a href="{{ route('panel.projects.edit', $project) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('panel.projects.destroy', $project) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
