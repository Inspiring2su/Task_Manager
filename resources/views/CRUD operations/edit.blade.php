@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>
    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Task Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $task->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" required>{{ $task->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection