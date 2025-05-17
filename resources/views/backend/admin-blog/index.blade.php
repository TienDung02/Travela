@extends('backend.layouts.layout')
@section('title', 'Blogs Management')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Blogs Management</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#blogModal" onclick="openBlogModal()">Add Blog</button>
        
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
   <form method="GET" class="mb-3 d-flex align-items-center" action="{{ route('admin.blog.index') }}">
        <label class="me-2">Filter by Category:</label>
        <select name="category_id" class="form-select w-auto me-2" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @if(request('category_id'))
            <a href="{{ route('admin.blog.index') }}" class="btn btn-link">Reset</a>
        @endif
    </form>
    
    <table class="table table-bordered bg-white">
     
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>User</th>
                <th>Status</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->category->name ?? '' }}</td>
                <td>{{ $blog->user->name ?? '' }}</td>
                <td>
                    @if($blog->active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d') : '-' }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#blogModal"
                        onclick="openBlogModal({{ $blog->toJson() }})">Edit</button>
                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Blog Modal -->
<div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="blogForm" method="POST">
        @csrf
        <input type="hidden" name="_method" id="formMethod" value="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="blogModalLabel">Add Blog</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" id="blogTitle" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" id="blogCategory" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" id="blogContent" class="form-control" rows="6" required></textarea>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="active" id="blogActive" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="blogSubmitBtn">Create</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    function openBlogModal(blog = null) {
        // Reset form
        document.getElementById('blogForm').reset();
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('blogModalLabel').innerText = 'Add Blog';
        document.getElementById('blogSubmitBtn').innerText = 'Create';
        document.getElementById('blogForm').action = "{{ route('admin.blog.store') }}";

        if (blog) {
            document.getElementById('blogModalLabel').innerText = 'Edit Blog';
            document.getElementById('blogSubmitBtn').innerText = 'Update';
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('blogForm').action = "/admin-blog/" + blog.id;
            document.getElementById('blogTitle').value = blog.title;
            document.getElementById('blogCategory').value = blog.category_id;
            document.getElementById('blogContent').value = blog.content;
            document.getElementById('blogActive').value = blog.active;
        }
    }
</script>
@endsection