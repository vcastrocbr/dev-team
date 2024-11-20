<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Task List') }}</h3>
                    <ul class="space-y-4 mt-4">
                        @foreach ($Tasks as $task)
                            <li class="flex justify-between">
                                <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-600 hover:underline">{{ $task->title }}</a>
                                <span class="text-sm text-gray-500">{{ $task->priority }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        {{ $Tasks->links() }}  <!-- Pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
