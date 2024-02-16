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
        $tasks = Task::query()
            ->filterByStatus($request->input('status'))
            ->filterByDueDate($request->input('due_date'))
            ->sortByField($request->input('sort_by'), $request->input('sort_order', 'asc'))
            ->get();
            $query = Task::with('user'); // Eager load the user relationship

            // Check if a search term is provided
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
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
