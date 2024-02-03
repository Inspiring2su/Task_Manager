@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Task Details</h1>
    <p><strong>Name:</strong> {{ $task->name }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
    <p><strong>Project:</strong> {{ optional($task->project)->name }}</p>
    <p><strong>Assigned To:</strong> {{ $task->user->name }}</p>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to list</a>
</div>
@endsection