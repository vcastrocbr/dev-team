<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskStoreRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        // Prepare the data for the task, including the uploaded file
        $formFields = $request->validated();
        $formFields['creator_id'] = Auth::id();
        $formFields['picture'] = null;

        // Check if a file was uploaded
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            // Generate a unique file name and get the file extension
            $fileName = uniqid('task_picture_', true) . '.' . $request->file('picture')->extension();
            // Store the file manually on a specific disk (local storage here)
            $filePath = 'pictures/' . $fileName;
            Storage::disk('public')->put($filePath, file_get_contents($request->file('picture')));
            // Add the file name to the data array (this will be saved to the database)
            $formFields['picture'] = $filePath;
        }
        try {
            // Create the task entry in the database
            Task::create($formFields);
            return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['error' => 'An error occurred while creating the task.']);
        }
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
        $formFields['picture'] = null;

        // Check if a new picture was uploaded
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            // Generate a unique file name and get the file extension
            $fileName = uniqid('task_picture_', true) . '.' . $request->file('picture')->extension();

            // Delete the old picture if it exists 
            if ($task->picture && Storage::disk('public')->exists($task->picture)) {
                Storage::disk('public')->delete($task->picture);
            }
            // Store the new picture on the public disk
            $filePath = 'pictures/' . $fileName;
            Storage::disk('public')->put($filePath, file_get_contents($request->file('picture')));
            // Update the picture path in the form fields
            $formFields['picture'] = $filePath;
        }
        $task->update($formFields);

        // Create the dynamic success message with task title (limited to 20 chars)
        $successMessage = 'Task ' . substr($task->title, 0, 20) . ' updated successfully!';

        // Redirect to the tasks.index route with a success message
        return redirect()->route('tasks.index')->with('success', $successMessage);
    }

    // Delete Task
    public function destroy(Task $task)
    {
        // Make sure logged in user is creator
        if ($task->creator_id !== Auth::id()) {
            abort(403, 'Unauthorized Action');
        }

        if ($task->picture && Storage::disk('public')->exists($task->picture)) {
            Storage::disk('public')->delete($task->picture);
        }
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
