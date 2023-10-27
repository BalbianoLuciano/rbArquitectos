@extends('layouts.admin')

@section('content')
    <div class="container pt-4">
        <!-- Project Details -->
        <div class="card mb-3">
            <div class="card-body">
                <h1 class="card-title"><strong>{{ $project->name }}</strong></h1>
                <p class="card-text"><small class="text-muted"><i class="bi bi-calendar-range"></i> {{ $project->start }} - {{ $project->end }}</small></p>
            </div>
        </div>
        <!-- Authors -->
        <div class="w-auto">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title pb-3" style="font-weight: bold;">Authors</h5>
                    <div class="card-text">
                        <div class="row p-3 border align-items-center justify-content-between">
                            @foreach ($project->authors as $author)
                                <p><strong>{{ $author->name }}</strong> - <span class="text-muted bg-dark badge"> <i class="bi bi-rulers mr-2"></i>{{ $author->pivot->project_role }}</span></p>
                                @if($author->hasMedia('image'))
                                    <img src="{{ $author->getFirstMediaUrl('image') }}" alt="{{ $author->name }}" class="img-fluid" style="max-height: 50px;">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Images -->
        <div class="w-full">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title pb-3" style="font-weight: bold;">Project Images</h5>
                    <div class="card-text d-flex flex-row flex-wrap">
                        @foreach($project->getMedia('projects') as $media)
                            <img src="{{ $media->getUrl() }}" alt="{{ $project->name }}" class="img-fluid mb-2" style="width: 300px; height: 200px; object-fit: cover;">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Associated Companies -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Associated Companies</h5>
                <div class="card-text">
                    @foreach($project->companies as $company)
                        <div class="mt-3">
                            <h6><strong><a href="{{ route('panel.companies.show', $company) }}">{{ $company->name }}</a></strong></h6>
                            <p class="mb-1">{{ $company->pivot->description }}</p>
                            <p class="mb-0"><span class="badge bg-primary"> <i class="bi bi-tools mr-2"></i>{{ $company->pivot->company_role }}</span> 
                            <small class="text-muted"><i class="bi bi-arrow-repeat"></i> {{ $company->pivot->project_update }}</small>
                            <small class="text-muted"><i class="bi bi-calendar-check"></i> {{ $company->pivot->start }} - {{ $company->pivot->end }}</small></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="pb-3">
            <a href="{{ route('panel.projects.edit', $project) }}" class="btn btn-warning me-2">Edit <i class="bi bi-pencil"></i></a>
            <form action="{{ route('panel.projects.destroy', $project) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete <i class="bi bi-trash"></i></button>
            </form>
            <a href="{{ route('panel.projects.index') }}" class="btn btn-secondary ms-2">Go Back <i class="bi bi-arrow-left-circle"></i></a>
        </div>
    </div>
@endsection
