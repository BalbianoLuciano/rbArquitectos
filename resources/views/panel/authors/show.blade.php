@extends('layouts.admin')

@section('content')
<div class="container pt-4">
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
            @foreach ($author->companies as $company)
                <div class="border rounded mt-3 p-3">
                    <h6><strong><a href="{{ route('panel.companies.show', $company) }}">{{ $company->name }}</a></strong></h6>
                    <small class="text-muted px-2"><i class="bi bi-arrow-repeat pr-2"></i> {{ $company->pivot->position }}</small>
                    <small class="text-muted px-2"><i class="bi bi-calendar-check pr-2"></i> {{ $company->pivot->start }} - {{ $company->pivot->end }}</small></p>
                </div>
            @endforeach
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
