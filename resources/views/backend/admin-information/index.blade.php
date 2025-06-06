@extends('backend.layouts.layout')
@section('title', 'User Management')
@section('content')
<div class="container py-4">
    <a href="{{ route('admin.information.create') }}" class="btn btn-primary mb-3">Add User</a>
    <table class="min-w-full divide-y divide-gray-200 table table-bordered bg-white">
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.information.edit', $user->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('admin.information.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete user?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection