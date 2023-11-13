@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h2 class="mb-0">
                {{ $author->name }}
            </h2>
            <small class="text-muted text-lg pr-2">({{ $author->date_of_birth ? $author->date_of_birth: 'Fecha desconocida' }})
            </small>
            -
            @if ($author->place_of_birth)
                <span class="text-lg">
                    <i class="bi bi-geo-fill bold pl-2"> </i> born in:   {{ $author->place_of_birth }}
                </span>
            @endif
        </div>
        <div class="card-body">
            <div class="d-flex align-items-start">
                @if($author->hasMedia('image'))
                    <div class="flex-shrink-0">
                        <img src="{{ $author->getFirstMediaUrl('image') }}" alt="{{ $author->name }}" class="img-fluid" style="max-height: 300px;">
                        {{-- Biografía --}}
                    </div>
                    <div class="author-biography bg-dark p-2 flex-grow-1" style="height: 300px; overflow-y: auto;">
                        <p>{{ $author->biography }}</p>
                    </div>
                @endif
        
            </div>
            <div class="py-3 text-bold text-uppercase text-lg">Companies in which he was involved</div>

            <div id="companiesAccordion">
                @forelse ($author->companies as $index => $company)
                    <div class="card" style="cursor: pointer" data-toggle="collapse" data-target="#companyCollapse{{ $index }}" aria-expanded="true" aria-controls="companyCollapse{{ $index }}">
                        <div class="card-header" id="companyHeading{{ $index }}">
                            <h5 class="mb-0">
                                <i class="fa fa-chevron-down float-right"></i>
                                <button class="btn" >
                                    {{ $company->name }}
                                </button>
                            </h5>
                        </div>

                        <div id="companyCollapse{{ $index }}" class="collapse" aria-labelledby="companyHeading{{ $index }}" data-parent="#companiesAccordion">
                            <div class="card-body">
                                <h6><strong><a href="{{ route('panel.companies.show', $company) }}">{{ $company->name }}</a></strong></h6>
                                <small class="text-muted px-2"><i class="bi bi-arrow-repeat pr-2"></i> {{ $company->pivot->position }}</small>
                                <small class="text-muted px-2"><i class="bi bi-calendar-check pr-2"></i> {{ $company->pivot->start }} - {{ $company->pivot->end ? $company->pivot->end->format('Y-m-d') : 'Present' }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="text-muted text-base">
                    the author has no companies yet.
                </div>
                @endforelse
            </div>


            <div class="py-3 text-bold text-uppercase text-lg">Projects in which he was involved</div>

            <div id="accordion">
                @foreach ($author->projects as $index => $project)
                    <div class="card" style="cursor: pointer" data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}">
                        <div class="card-header" id="heading{{ $index }}">
                            <h5 class="mb-0">
                                <i class="fa fa-chevron-down float-right"></i>
                                <button class="btn" >
                                    {{ $project->name }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}" data-parent="#accordion">
                            <div class="card-body">
                                <h6><strong><a href="{{ route('panel.projects.show', $project) }}">{{ $project->name }}</a></strong></h6>
                                <small class="text-muted px-2"><i class="bi bi-arrow-repeat pr-2"></i> {{ $project->pivot->project_role }}</small>
                                <!-- Aquí puedes incluir más detalles del proyecto si lo deseas -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>              
        <div class="card-footer">
            <a href="{{ route('panel.authors.edit', $author) }}" class="btn btn-warning"> Editar <i class="bi bi-pencil ml-2"></i></a>
            <form action="{{ route('panel.authors.destroy', $author) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar<i class="bi bi-trash ml-2"></i></button>
            </form>
            <a href="{{ route('panel.authors.index') }}" class="btn btn-secondary">Volver<i class="bi bi-arrow-left-circle ml-2"></i></a>
        </div>
    </div>
</div>
@endsection
