@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create Project</h1>
    <form action="{{ route('projects.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf {{-- CSRF token to protect your form --}}

        {{-- Project Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback">
                Please provide a project name.
            </div>
        </div>

        {{-- Project Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        {{-- Project Deadline --}}
        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline:</label>
            <input type="date" class="form-control" id="deadline" name="deadline">
        </div>

        {{-- Submit Button --}}
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Create Project</button>
        </div>
    </form>
</div>

    
@endsection
