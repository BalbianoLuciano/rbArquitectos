@extends('layouts.admin')

@section('content')
    <div class="container pt-4">
        <!-- Project Details -->
        <div class="card mb-3">
            <div class="card-body">
                <h1 class="card-title"><strong>{{ $project->name }}</strong></h1>
                <p class="card-text"><small class="text-muted"><i class="bi bi-calendar-range"></i> {{ $project->start }} - {{ $project->end }}</small></p>
                <p class="card-text text-base">{{ $project->description }}</p>
                <!-- Indicador de si es 'Otro Proyecto' -->
                @if($project->isOtherProject === 1)
                    <p class="text-muted fst-italic">This is an Other Project.</p>
                @else
                    <p class="text-muted fst-italic">This is a Our Project.</p>
                @endif
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
        <!-- Authors -->
        <div class="w-auto">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="pb-3" style="font-weight: bold;">Authors</h5>
                    <div id="authorsAccordion">
                        @foreach ($project->authors as $index => $author)
                            <div class="card" style="cursor: pointer" data-toggle="collapse" data-target="#authorCollapse{{ $index }}" aria-expanded="true" aria-controls="authorCollapse{{ $index }}">
                                <div class="card-header" id="authorHeading{{ $index }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-block text-left">
                                            {{ $author->name }}
                                            <i class="fa fa-chevron-down float-right"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="authorCollapse{{ $index }}" class="collapse" aria-labelledby="authorHeading{{ $index }}" data-parent="#authorsAccordion">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p>
                                                <strong>{{ $author->name }}</strong> - 
                                                <span class="text-muted bg-dark badge">
                                                    <i class="bi bi-rulers mr-2"></i>{{ $author->pivot->project_role }}
                                                </span>
                                            </p>
                                            @if($author->hasMedia('image'))
                                                <img src="{{ $author->getFirstMediaUrl('image') }}" alt="{{ $author->name }}" class="img-fluid" style="max-height: 50px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Associated Companies -->
        <div class="card">
            <div class="card-body">
                <h5 class="pb-3"  style="font-weight: bold;">Associated Companies</h5>
                <div id="associatedCompaniesAccordion">
                    @foreach($project->companies as $index => $company)
                        <div class="card" style="cursor: pointer">
                            <div class="card-header" id="companyHeading{{ $index }}" data-toggle="collapse" data-target="#companyCollapse{{ $index }}" aria-expanded="true" aria-controls="companyCollapse{{ $index }}">
                                <h6 class="mb-0">
                                    <button class="btn">
                                        {{ $company->name }}
                                    </button>
                                    <i class="fa fa-chevron-down float-right"></i>
                                </h6>
                            </div>
                            <div id="companyCollapse{{ $index }}" class="collapse" aria-labelledby="companyHeading{{ $index }}" data-parent="#associatedCompaniesAccordion">
                                <div class="card-body">
                                    <strong><a href="{{ route('panel.companies.show', $company) }}">{{ $company->name }}</a></strong>
                                    <p class="mb-1">{{ $company->pivot->description }}</p>
                                    <p class="mb-0">
                                        <span class="badge bg-primary"> <i class="bi bi-tools mr-2"></i>{{ $company->pivot->company_role }}</span> 
                                        <small class="text-muted"><i class="bi bi-arrow-repeat"></i> {{ $company->pivot->project_update }}</small>
                                        <small class="text-muted"><i class="bi bi-calendar-check"></i> {{ $company->pivot->start }} - {{ $company->pivot->end }}</small>
                                    </p>
                                </div>
                            </div>
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
