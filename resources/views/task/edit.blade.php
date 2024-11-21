<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title', $task->title)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                :value="old('description', $task->description)" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Start Date -->
                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                                :value="old('start_date', $task->start_date)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>

                        <!-- Priority -->
                        <div>
                            <x-input-label for="priority" :value="__('Priority')" />
                            <select id="priority" name="priority" class="block mt-1 w-full" required>
                                <option value="low"
                                    {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium"
                                    {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high"
                                    {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                        </div>

                        <!-- Picture -->
                        <div>
                            <x-input-label for="picture" :value="__('Picture')" />
                            <x-text-input id="picture" name="picture" type="file" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('picture')" />
                            <!-- Show current picture if available -->
                            <div class="mt-2">
                                <img class="w-48"
                                    src="{{ $task->picture ? asset('storage/' . $task->picture) : asset('/images/gradient-bg1.png') }}"
                                    alt="Task Picture" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
