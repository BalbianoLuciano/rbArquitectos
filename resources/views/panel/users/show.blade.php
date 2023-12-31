@extends('layouts.admin')

@section('title', 'User Details')

@section('content_header')
    <h1>{{ $user->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2>Details</h2>
                    <p>ID: {{ $user->id }}</p>
                    <p>Name: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>

                    <h4>Roles</h4>
                    @if ($user->roles->count() == 0)
                        <p>This user don't have any roles.</p>
                    @else
                        <ul>
                            @foreach ($user->roles as $role)
                                <li>{{ $role->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('panel.users.edit', $user->id) }}" class="btn btn-warning">Edit <i class="bi bi-pencil pl-2"></i></a>
                        <form action="{{ route('panel.users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-message="eliminar a este usuario '{{ $user->name }}'" role="confirm">Delete <i class="bi bi-trash pl-2"></i></button>
                        </form>
                        <a href="{{ route('panel.users.index') }}" class="btn btn-secondary">Go back <i class="bi bi-arrow-left-circle pl-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
