@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $music->title }}</h1>
        <p><strong>Artist:</strong> {{ $music->artist }}</p>
        <p><strong>Genre:</strong> {{ $music->genre }}</p>
        <p><strong>File Path:</strong> {{ $music->file_path }}</p>

        <h3>Tags:</h3>
        <ul>
            @foreach ($music->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>

        <a href="{{ route('musics.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('musics.edit', $music) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('musics.destroy', $music) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
