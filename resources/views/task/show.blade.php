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
                <div class="max-w-xl text-gray-600">
                    <h3 class="text-lg font-medium text-gray-900">{{ $task->title }}</h3>
                    <p class="mt-2">{{ $task->description ?? 'No description available.' }}</p>
                    <p class="mt-2">Start Date:</p>
                    <p> {{ $task->start_date }}</p>
                    <p class="mt-2">Priority:</p>
                    <p>{{ ucfirst($task->priority) }}</p>
                    <p class="mt-2">Picture:</p>
                    <img class="w-48"
                    src="{{ $task->picture ? asset('storage/' . $task->picture) : asset('/images/gradient-bg1.png') }}"
                    alt="Task Picture" />
                </div>
            </div>

            <!-- Check if the logged-in user is the creator -->
            @if (Auth::check() && Auth::user()->id === $task->creator_id)
                <div class="flex gap-4 mt-6">
                    <!-- Edit button links to the edit form for this task -->
                    <a href="{{ route('tasks.edit', $task->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit Task</a>

                    <!-- Delete form -->
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete Task</button>
                    </form>
                </div>
            @endif
            <!-- Back Button -->
            <div class="mt-4 flex justify-center">
                <a href="{{ route('tasks.index') }}"
                    class="inline-block bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                    {{ __('Back to Tasks List') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
