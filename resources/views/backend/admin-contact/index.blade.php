@extends('backend.layouts.layout')
@section('title', 'Contact Management')
@section('content')
<div class="container py-4">
    <h2>Contact Messages</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="min-w-full divide-y divide-gray-200 table table-bordered bg-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Name / Email</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>
                    <strong>{{ $contact->name }}</strong><br>
                    <small>{{ $contact->email }}</small>
                    @if($contact->phone)<br><small>{{ $contact->phone }}</small>@endif
                </td>
                <td>{{ $contact->subject }}</td>
                <td>
                    <form action="{{ route('admin.contact.update', $contact->id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                            <option value="new" @if($contact->status == 'new') selected @endif>New</option>
                            <option value="pending" @if($contact->status == 'pending') selected @endif>Pending</option>
                            <option value="processed" @if($contact->status == 'processed') selected @endif>Processed</option>
                        </select>
                    </form>
                </td>
                <td>{{ $contact->created_at }}</td>
                <td style="max-width:300px;word-break:break-word;">
                    <details>
                        <summary>Show</summary>
                        <div>
                            <strong>Message:</strong> {{ $contact->message }}
                        </div>
                    </details>
                </td>
                <td>
                    <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this contact?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection