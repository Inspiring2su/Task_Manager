@extends('layouts.app')

@section('content')
<div class="container" class="text-center">
<div class="container mt-4">
    <h1>Tasks List</h1>


    <form method="GET" action="{{ route('tasks.index') }}" class="mb-4">
        <div class="row align-items-center">
            <div class="col-auto">
                <select name="status" class="form-select">
                    <option value="">Select Status</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <div class="col-auto">
                <input type="date" name="due_date" value="{{ request('due_date') }}" class="form-control">
            </div>
            <div class="col-auto">
                <select name="sort_by" class="form-select">
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Task Name</option>
                    <option value="deadline" {{ request('sort_by') == 'deadline' ? 'selected' : '' }}>Due Date</option>
                </select>
            </div>

            <div class="col-auto">
                <select name="sort_order" class="form-select">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Sort</button>
            </div>
            <form action="{{ route('tasks.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search by user name" value="{{ request('search') }}">
            <button type="submit">Search</button>
            </form>
            @foreach ($tasks as $task)
            <div>{{ $task->name }} - Assigned to: {{ $task->user->name ?? 'N/A' }}</div>
            @endforeach            
        </div>
    </form>

    {{-- Tasks Table --}}
    <table class="table">
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Project Id</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->project_id }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary btn-sm" class="d-inline" >View</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Create New Task Button --}}
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
</div>

@endsection
