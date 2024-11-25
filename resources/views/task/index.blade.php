<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks List') }}
        </h2>
    </x-slot>

    <div class="py-8" x-data="{ viewType: '{{ $viewType }}' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <!-- Button to Create New Task -->
            <div class="flex justify-between items-center">
                <div class="w-1/4">
                    <x-flash-message />
                </div>
                <x-primary-button :href="route('tasks.create')">
                    {{ __('Create New Task') }}
                </x-primary-button>
            </div>

            <!-- Secondary Button toggle between cards and table view -->
            <div class="flex justify-end">
                <x-secondary-button
                    @click="
                viewType = (viewType === 'cards' ? 'table' : 'cards');
                const url = new URL(window.location.href);
                url.searchParams.set('viewType', viewType);
                window.history.pushState({}, '', url);
                document.location.reload();
            ">
                    <span x-text="viewType === 'cards' ? 'Table' : 'Cards'"></span>
                </x-secondary-button>
            </div>

            <!-- Content Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!-- Conditional rendering based on viewType -->
                <template x-if="viewType === 'table'">
                    <div>
                        <!-- Table for All Tasks List -->
                        <h3 class="mt-4 font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('All Tasks') }}
                        </h3>
                        <table class="min-w-full mt-4 table-auto">
                            <!-- Table Header -->
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                        {{ __('Task Title') }}
                                    </th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                        {{ __('Priority') }}
                                    </th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                        {{ __('Start Date') }}
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody>
                                @foreach ($allTasks as $task)
                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-sm text-gray-900">
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="text-blue-600 hover:underline">{{ $task->title }}</a>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-500">
                                            {{ ucfirst($task->priority) }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-500">
                                            {{ $task->start_date }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $allTasks->appends(request()->query())->links() }}
                        </div>
                    </div>
                </template>

                <template x-if="viewType === 'cards'">
                    <div>
                        <!-- Cards View -->
                        <h3 class="mt-4 font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('All Tasks - Cards') }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                            @foreach ($allTasks as $task)
                                <x-task-card :task="$task" />
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $allTasks->appends(request()->query())->links() }}
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-app-layout>
