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
                    <p>{{ \App\Enums\TaskPriority::from($task->priority)->label() }}</p>
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

                    <!-- Delete form with a modal confirmation -->
                    <div x-data="{ open: false }">
                        <!-- Trigger button -->
                        <button @click="open = true"
                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            Delete Task
                        </button>

                        <!-- Modal for confirmation -->
                        <div x-show="open" x-transition
                            class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
                            <div @click.away="open = false" class="bg-white rounded-lg p-6 max-w-sm w-full">
                                <h2 class="text-xl font-semibold mb-4">Are you sure you want to delete this task?</h2>
                                <p class="mb-6">This action cannot be undone.</p>

                                <!-- Modal buttons -->
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="flex gap-8">
                                    <button type="submit"
                                        class="w-full bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-4">
                                        Yes
                                    </button>
                                    <button @click="open = false" type="button"
                                        class="w-full bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 mr-4">
                                        Cancel
                                    </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
