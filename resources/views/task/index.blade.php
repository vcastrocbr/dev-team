<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks List') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Button to Create New Task -->
            <div class="flex justify-between items-center">
                <div class="w-1/4">
                    <x-flash-message />
                </div>
                <a href="{{ route('tasks.create') }}"
                    class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    {{ __('Create New Task') }}
                </a>
            </div>

            <!-- Task List -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!-- Centered Table Container -->
                <div class="flex justify-center">
                    <div class="w-full max-w-3xl">
                        <!-- Table for Task List -->
                        <table class="min-w-full mt-4 table-auto">
                            <!-- Table Header -->
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                        {{ __('Task Title') }}</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                        {{ __('Priority') }}
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-sm text-gray-900">
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="text-blue-600 hover:underline">{{ $task->title }}</a>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-500">
                                            {{ $task->priority }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $tasks->links() }} <!-- Pagination links -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
