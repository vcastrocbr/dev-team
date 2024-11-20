<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    // Show all Tasks
    public function index()
    {
        return view('task.index', [
            'tasks' => Task::latest()->paginate(10)
        ]);
    }

    //Show single Task
    public function show(Task $task)
    {
        return view('task.show', [
            'task' => $task
        ]);
    }

    // Show Create Form
    public function create()
    {
        return view('task.create');
    }



    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);


        $formFields['creator_id'] = Auth::id();

        Task::create($formFields);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // Show Edit Form
    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    // Update Task Data
    public function update(Request $request, Task $task)
    {
        // Ensure the user can update this task
        if ($task->creator_id !== Auth::id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($formFields);

        return back()->with('message', 'Task updated successfully!');
    }

    // Delete Task
    public function destroy(Task $task)
    {
        // Ensure the user can delete this task
        if ($task->creator_id !== Auth::id()) {
            abort(403, 'Unauthorized Action');
        }

        $task->delete();

        return redirect('/')->with('message', 'Task deleted successfully');
    }
}
