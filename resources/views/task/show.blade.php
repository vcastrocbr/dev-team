<!-- Task Show View (show.blade.php) -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">{{ $task->title }}</h3>
                    <p class="mt-2 text-gray-600">{{ $task->description ?? 'No description available.' }}</p>
                    <p class="mt-2 text-gray-600">Start Date: {{ $task->start_date }}</p>
                    <p class="mt-2 text-gray-600">Priority: {{ ucfirst($task->priority) }}</p>
                </div>
            </div>

            <div class="flex gap-4">
                <!-- Edit button links to the edit form for this task -->
                <a href="{{ route('tasks.edit', $task->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Edit Task</a>

                <!-- Delete form -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Delete Task</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
