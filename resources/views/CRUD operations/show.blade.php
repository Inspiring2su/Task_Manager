@extends('layouts.app')

@section('content')
    <h1>Task: {{ $task->name }}</h1>
    <p>Description: {{ $task->description }}</p>
    <a href="{{ route('tasks.index') }}">Back to List</a>
@endsection