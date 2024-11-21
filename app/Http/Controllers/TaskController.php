<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskStoreRequest;

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



    public function store(TaskStoreRequest $request)
    {
        // Merge the authenticated user's ID as creator_id into the request data
        $formFields = $request->validated();
        $formFields['creator_id'] = Auth::id();

        // Handle the picture upload if a file is provided
    if ($request->hasFile('picture')) {
        // Get the uploaded picture file
        $picture = $request->file('picture');

        // Generate a unique file name (you can customize this)
        $picturePath = $picture->store('pictures', 'public'); // Store it in the 'public' disk, inside 'pictures' directory

        // Add the file path to the form data
        $formFields['picture'] = $picturePath;
    }

        // Create the task with the merged data
        Task::create($formFields);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // Show Edit Form
    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    // Update Task Data
    public function update(TaskStoreRequest $request, Task $task)
    {
        $formFields = $request->validated();
        $task->update($formFields);

        // Redirect to the tasks.index route with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }


    // Delete Task
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
