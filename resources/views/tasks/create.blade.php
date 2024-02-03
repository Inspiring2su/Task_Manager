@extends('layouts.app')

@section('content')
<div class="container" class="text-center">
    <h1>Create Task</h1>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Task Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div> <br>
        <div class="form-group">
            <label for="description">Task Description:</label>
            <textarea class="form-control" name="description" id="description" required></textarea>
        </div> <br>
        <div class="form-group">
            <label for="deadline">Task Deadline:</label>
            <input class="form-control" name="deadline" id="deadline" type= "date" required></textarea>
        </div> <br>
                <!-- Status Field -->
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
        </div> <br>
        <!-- Project ID Field -->
        <div class="form-group">
            <label for="project_id">Project</label>
            <select name="project_id" id="project_id" required>
                @foreach(App\Models\Project::all() as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div><br>
        <!-- User ID Field -->
        <div class="form-group">
            <label for="user_id">Assignee</label>
            <select name="user_id" id="user_id" required>
                @foreach(App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div> <br>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
