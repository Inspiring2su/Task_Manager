@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Project Details</h1>
    
    {{-- Project Name --}}
    <div class="form-group">
        <label for="name"><strong>Name:</strong></label>
        <p id="name">{{ $project->name }}</p>
    </div>
    
    {{-- Project Description --}}
    <div class="form-group">
        <label for="description"><strong>Description:</strong></label>
        <p id="description">{{ $project->description }}</p>
    </div>
    
    {{-- Project Deadline --}}
    <div class="form-group">
        <label for="deadline"><strong>Deadline:</strong></label>
        <p id="deadline">{{ $project->deadline ? $project->deadline : 'N/A' }}</p>
    </div>
    
    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">Edit Project</a>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
</div>
@endsection