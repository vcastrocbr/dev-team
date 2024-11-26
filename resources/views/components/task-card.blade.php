@props(['task'])

<div class="flex flex-col bg-white shadow-sm sm:rounded-lg p-6 text-gray-900 space-y-4 p-4 bg-white/5 rounded-xl border border-transparent hover:border-blue-800 group transition-colors duration-300">
    <div class="self-start text-sm text-gray-500">{{ ucfirst($task->priority) }}</div>

    <div class="group">
        <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-800 transition-colors duration-300">
            <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-600 hover:underline">
                {{ $task->title }}
            </a>
        </h3>
        <p class="text-sm mt-2 text-gray-600">{{ $task->description }}</p>
    </div>

    <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-500">{{ $task->start_date }}</p>
        @if ($task->picture)
            <img 
             class="rounded-xl w-12 h-12 object-cover"
             src="{{ $task->picture ? asset('storage/' . $task->picture) : asset('/images/gradient-bg1.png') }}"
                    alt="Task Picture" />
        @endif
    </div>
</div>