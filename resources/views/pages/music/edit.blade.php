@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Music</h1>

        <form action="{{ route('musics.update', $music) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $music->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="artist" class="form-label">Artist</label>
                <input type="text" class="form-control" id="artist" name="artist" value="{{ old('artist', $music->artist) }}">
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $music->genre) }}">
            </div>

            <div class="mb-3">
                <label for="file_path" class="form-label">File Path</label>
                <input type="text" class="form-control" id="file_path" name="file_path" value="{{ old('file_path', $music->file_path) }}" required>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" 
                            @if($music->tags->contains($tag->id)) selected @endif>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Music</button>
        </form>
    </div>
@endsection
