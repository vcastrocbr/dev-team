<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Music Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl text-gray-600">
                    <h3 class="text-lg font-medium text-gray-900">{{ $music->title }}</h3>
                    <p class="mt-2"><strong>Artist:</strong> {{ $music->artist }}</p>
                    <p class="mt-2"><strong>Genre:</strong> {{ $music->genre }}</p>
                    <p class="mt-2"><strong>File Path:</strong> {{ $music->file_path }}</p>

                    <h4 class="mt-4 font-semibold text-gray-900">Tags:</h4>
                    <ul class="list-disc list-inside">
                        @foreach ($music->tags as $tag)
                            <li>{{ $tag->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
                <div class="flex gap-4 mt-6">
                    <!-- Edit button -->
                    <a href="{{ route('musics.edit', $music->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Edit Music
                    </a>

                    <!-- Delete form with modal confirmation -->
                    <div x-data="{ open: false }">
                        <!-- Trigger button -->
                        <button @click="open = true"
                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            Delete Music
                        </button>

                        <!-- Modal for confirmation -->
                        <div x-show="open" x-transition
                            class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
                            <div @click.away="open = false" class="bg-white rounded-lg p-6 max-w-sm w-full">
                                <h2 class="text-xl font-semibold mb-4">Are you sure you want to delete this music?</h2>
                                <p class="mb-6">This action cannot be undone.</p>

                                <!-- Modal buttons -->
                                <form action="{{ route('musics.destroy', $music->id) }}" method="POST">
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

            <!-- Back Button -->
            <div class="mt-4 flex justify-center">
                <a href="{{ route('musics.index') }}"
                    class="inline-block bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                    {{ __('Back to Music List') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
