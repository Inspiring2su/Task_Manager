<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();
    
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
    
        // Filter by due date
        if ($request->has('due_date')) {
            $query->whereDate('deadline', $request->input('due_date'));
        }
    
        // Sorting
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $sortOrder = $request->input('sort_order', 'asc');
            
            if (in_array($sortBy, ['deadline', 'name'])) {
                $query->orderBy($sortBy, $sortOrder);
            }
        }
    
        $tasks = $query->get();
        return view('tasks.index', compact('tasks'));
    }
    
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return view('tasks.create', compact('users', 'projects'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
            'status' => 'required|in:pending,completed',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::create($validatedData);   
                
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
    
    public function edit(Task $task)
    {
        $users = User::all();
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'users', 'projects'));
    }
    
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
            'status' => 'required|in:pending,completed',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $task->update($validatedData);
        
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
