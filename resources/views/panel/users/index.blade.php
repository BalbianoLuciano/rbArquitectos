@extends('layouts.admin')

@section('title', 'Users List')

@section('content_header')
    <h1>Users List</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
            <div class="card-tools">
                <a href="{{ route('panel.users.create') }}" class="btn btn-primary">
                    Create User <i class="bi bi-plus-circle ml-2"></i>
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr class="table-header">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="text-center align-middle">{{ $user->id }}</td>
                            <td class="text-center align-middle">{{ $user->name }}</td>
                            <td class="text-center align-middle">{{ $user->email }}</td>
                            <td class="text-center align-middle">{{ $user->created_at->format('d-m-Y') }}</td>
                            <td class="text-center align-middle">
                                @foreach ($user->roles as $role)
                                    <span class="badge badge-dark">{{ $role->name }}</span><br>
                                @endforeach
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('panel.users.edit', $user) }}" class="btn btn-warning">
                                    Edit <i class="bi bi-pencil ml-2"></i>
                                </a>
                                <a href="{{ route('panel.users.show', $user) }}" class="btn btn-info">
                                    Show <i class="bi bi-eye ml-2"></i>
                                </a>
                                <form action="{{ route('panel.users.destroy', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                        Delete <i class="bi bi-trash ml-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $users->links() }}
        </div>
    </div>
@stop