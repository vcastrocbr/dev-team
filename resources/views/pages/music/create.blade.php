<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Music') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Create a New Music') }}</h3>

                    <form action="{{ route('musics.store') }}" method="POST" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Artist -->
                        <div>
                            <x-input-label for="artist" :value="__('Artist')" />
                            <x-text-input id="artist" name="artist" type="text" class="mt-1 block w-full"
                                :value="old('artist')" />
                            <x-input-error class="mt-2" :messages="$errors->get('artist')" />
                        </div>

                        <!-- Genre -->
                        <div>
                            <x-input-label for="genre" :value="__('Genre')" />
                            <select id="genre" name="genre"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                @foreach ($genres as $value => $label)
                                    <option value="{{ $value }}" {{ old('genre') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('genre')" />
                        </div>

                        <!-- File Path -->
                        <div>
                            <x-input-label for="file_path" :value="__('File Path')" />
                            <x-text-input id="file_path" name="file_path" type="text" class="mt-1 block w-full"
                                :value="old('file_path')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('file_path')" />
                        </div>

                        <!-- Tags -->

                        <div class="p-4 border border-gray-300 rounded-lg" id="tags-container"
                            data-tags='{{ $tagsJson }}'>
                            <div>
                                <x-input-label for="tags" :value="__('Tags')" />
                                <div class="grid grid-cols-2 gap-4 mt-2 mx-2 px-2 py-2 overflow-y-auto max-h-32">
                                    @foreach ($tags as $tag)
                                        <div class="flex items-center relative">
                                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                id="tag-{{ $tag->id }}"
                                                class="rounded border-gray-300 text-gray-800 shadow-sm focus:ring-gray-500"
                                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                            <label for="tag-{{ $tag->id }}" class="ml-2 text-sm text-gray-600">
                                                {{ $tag->name }}
                                            </label>
                                            <button class="delete-tag ml-2 text-gray-600" type="button">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('tags')" />
                            </div>
                            <!-- Add Tag -->
                            <div class="mt-6">
                                <x-input-label for="create_tag" :value="__('Create Tag')" />
                                <div class="flex items-center gap-4 mt-1">
                                    <x-text-input id="create_tag" name="create_tag" type="text"
                                        class="mt-1 block w-2/3" :value="old('create_tag')" />
                                    <button id="addTagButton" type="button"
                                        class="border border-gray-300 px-4 py-2 mt-1 w-1/3 hover:bg-gray-200 focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm">
                                        {{ __('Add Tag') }}
                                    </button>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('create_tag')" />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Music') }}</x-primary-button>
                            <x-secondary-button :href="route('musics.index')">{{ __('Back') }}</x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/tag-manager.js')
    @endpush
</x-app-layout>
