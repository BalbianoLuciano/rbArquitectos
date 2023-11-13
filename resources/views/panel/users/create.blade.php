@extends('layouts.admin')

@section('title', 'Create User')

@section('content_header')
    <h1>Create User</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('panel.users.store') }}" method="POST" class="mt-3" role="validate">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
        
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control"  required>
            </div>
        
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
        
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Roles</label>
                <select name="roles[]" id="roles" class="form-control" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible p-0 fade show position-fixed d-flex align-items-center"
                    style="top: 20px; right: 20px; z-index: 1050; white-space: normal;"
                    role="alert">
                    @foreach ($errors->all() as $error)
                        <i class="bi bi-exclamation-square-fill text-black px-2"></i>
                        <span>{{ $error }}</span>
                    @endforeach
                    <button type="button" data-bs-dismiss="alert" class="" aria-label="Close" style="background: none; border: none;"><i class="bi bi-x-square-fill text-danger"></i></button>
                </div>
            @endif
        
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save<i class="bi bi-check-circle pl-2"></i></button>
                <a href="{{ route('panel.users.index') }}" class="btn btn-secondary">Cancel<i class="bi bi-arrow-left-circle pl-2"></i></a>
            </div>
        </form>
    </div>
</div>
@stop

{{-- @push('js')
@vite('resources/js/form.js')
@endpush --}}
