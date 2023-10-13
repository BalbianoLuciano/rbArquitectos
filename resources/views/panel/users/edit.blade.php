@extends('layout.admin')

@section('title', 'Update User')

@section('content_header')
    <h1>Update User</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('panel.users.update', ['user' => $user->id]) }}" method="POST" class="mt-3" role="validate">
            @csrf
            @method('PATCH')

        
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{  $user->name }}" required>
            </div>
        
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            @if ($errors->any())
                <div class="alert alert-warning text-white alert-dismissible fade show position-fixed d-flex align-items-center"
                    style="top: 20px; right: 20px; z-index: 1050; max-width: 300px; white-space: nowrap;"
                    role="alert">

                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close m-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('panel.users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{  route('panel.users.changepassword', ['user' => $user->id]) }}" method="POST" class="mt-3" role="validate">
            @csrf
            @method('PATCH')

        
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password"  id="password" class="form-control" required>
            </div>
        
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
        
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('panel.users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop