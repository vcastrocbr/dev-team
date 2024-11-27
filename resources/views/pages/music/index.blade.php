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
                <h1 class="font-bold text-gray-700">Music List</h1>
                <div class="w-2/3">
                    @if ($musics->isEmpty())
                        <p>No musics found in the database.</p>
                    @else
                        <div class="mt-6 font-semibold text-gray-600 flex">
                            <div class="w-1/2">Title</div>
                            <div class="w-1/2">Artist</div>
                        </div>
                        <ul class="space-y-2 mt-4">
                            @foreach ($musics as $music)
                                <li class="flex">
                                    <div class="w-1/2">
                                        <a href="{{ route('musics.show', $music->id) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $music->title }}
                                        </a>
                                    </div>
                                    <div class="w-1/2">
                                        <span>{{ $music->artist }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
