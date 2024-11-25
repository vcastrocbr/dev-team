<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Music List') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <!-- Button to Create New Music -->
            <div class="flex justify-between items-center">
                <div class="w-1/4">
                    <x-flash-message />
                </div>
                <x-primary-button :href="route('musics.create')">
                    {{ __('Create New Music') }}
                </x-primary-button>
            </div>

            <!-- Content Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!-- Conditional rendering based on viewType -->

                <div>
                    <!-- Music List -->
                    <h1 class="font-semibold text-gray-600">Music List</h1>
                    @if ($musics->isEmpty())
                        <p>No music found.</p>
                    @else
                        <ul class="space-y-2 mt-4">
                            <li class="flex justify-between items-center font-semibold text-gray-600">
                                <span class="ml-4">Title</span>
                                <span class="mr-4">Artist</span>
                            </li>
                            @foreach ($musics as $music)
                                <li class="flex justify-between items-center">
                                    <a href="{{ route('musics.show', $music->id) }}"
                                        class="text-blue-600 hover:underline">
                                        {{ $music->title }}
                                    </a>
                                    <span>{{ $music->artist }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
</x-app-layout>
