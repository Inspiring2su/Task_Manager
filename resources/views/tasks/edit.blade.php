@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Task</h1>
    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT') {{-- Specify the method to be used by the form (Laravel uses this to simulate PUT requests) --}}
    
        <!-- Task Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Task Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $task->name }}" required>
        </div>
    
        <!-- Task Description Field -->
        <div class="mb-3">
            <label for="description" class="form-label">Task Description:</label>
            <textarea class="form-control" name="description" id="description" rows="3" required>{{ $task->description }}</textarea>
        </div>
    
        <!-- Task Deadline Field -->
        <div class="mb-3">
            <label for="deadline" class="form-label">Task Deadline:</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}" required>
        </div>
    
        <!-- Status Field -->
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
    
        <!-- Project ID Field -->
        <div class="mb-3">
            <label for="project_id" class="form-label">Project:</label>
            <select name="project_id" id="project_id" class="form-control" required>
                @foreach(App\Models\Project::all() as $project)
                    <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <!-- User ID Field -->
        <div class="mb-3">
            <label for="user_id" class="form-label">Assignee:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach(App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

@endsection