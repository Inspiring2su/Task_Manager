@extends('layouts.app')

@section('content')
    <h1>Tasks List</h1>
    <a href="{{ route('tasks.create') }}">Create New Task</a>
    <ul>
        @foreach ($tasks as $task)
            <li>
                <a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a>
                <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
            </li>
        @endforeach
    </ul>
@endsection