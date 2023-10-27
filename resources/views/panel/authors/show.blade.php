@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h2 class="mb-0">{{ $author->name }}</h2>
        </div>
        <div class="card-body">
            @if($author->hasMedia('image'))
                <div class="text-center mb-3">
                    <img src="{{ $author->getFirstMediaUrl('image') }}" alt="{{ $author->name }}" class="img-fluid" style="max-height: 300px;">
                </div>
            @endif
            <div class="author-biography">
                <p>{{ $author->biography }}</p>
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

@section('additional-css')
<style>
    .author-biography p {
        text-align: justify;
    }
</style>
@endsection
