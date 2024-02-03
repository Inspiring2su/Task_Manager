@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Project</h1>
    <form action="{{ route('projects.update', $project->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf {{-- CSRF token to protect your form --}}
        @method('PUT') {{-- Spoofing the PUT HTTP method necessary for the update operation --}}
        
        {{-- Project Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
            <div class="invalid-feedback">
                Please provide a project name.
            </div>
        </div>
        
        {{-- Project Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $project->description }}</textarea>
        </div>
        
        {{-- Project Deadline --}}
        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline:</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') }}">
        </div>
        
        {{-- Submit Button --}}
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

    @endsection