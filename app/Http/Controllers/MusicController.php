<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Music;
use App\Enums\MusicGenre;
use Illuminate\Http\Request;
use App\Http\Requests\MusicStoreRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MusicController extends Controller
{
    use AuthorizesRequests;

    // Display a listing of the music.
    public function index()
    {
        $musics = Music::with('tags')->get();

        return view('pages.music.index', compact('musics'));
    }


    // Show the details of a specific music.
    public function show(Music $music)
    {
        // Load the associated tags
        $music->load('tags');

        // Return the view with the music data
        return view('pages.music.show', compact('music'));
    }


    // Show the form for creating a new music.
    public function create()
    {
        $tags = Tag::all();
        $genres = MusicGenre::options();

        // Convert tags to a simple array of names on JSON format
        $tagsJson = $tags->pluck('name')->toJson();

        // Pass the JSON data to the view
        return view('pages.music.create', compact('tags', 'genres', 'tagsJson'));
    }

    
    // Show the form for editing the specified music.
    public function edit(Music $music)
    {
        $tags = Tag::all();  // Get all tags for editing
        $genres = MusicGenre::options();

        return view('pages.music.edit', compact('music', 'tags', 'genres'));
    }


    // Store a newly created music in the database.
    public function store(MusicStoreRequest $request)
    {
        // Validate the music data
        $validatedFields = $request->validated();

        // Create a new music entry
        $music = Music::create($validatedFields);

        // Validate the tags
        $validatedTags  = $request->validate([
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        // Attach tags if provided
        if (isset($validatedTags['tags']) && !empty($validatedTags['tags'])) {
            $music->tags()->attach($validatedTags['tags']);
        }

        return redirect()->route('musics.index')->with('success', 'Music created successfully');
    }


    // Update the specified music in the database.
    public function update(MusicStoreRequest $request, Music $music)
    {
        $this->authorize('update', $music);

        // Validate the music data
        $validatedFields = $request->validated();

        // Update the music details
        $music->update($validatedFields);

        // Validate the tags
        $validatedTags  = $request->validate([
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        // Sync the selected tags to the music
        $music->tags()->sync($validatedTags['tags'] ?? []);

        return redirect()->route('musics.index')->with('success', 'Music updated successfully');
    }


    // Remove the specified music from the database.
    public function destroy(Music $music)
    {
        $this->authorize('delete', $music);
        
        // Detach tags before deleting
        $music->tags()->detach();

        // Delete the music
        $music->delete();

        return redirect()->route('musics.index')->with('success', 'Music deleted successfully');
    }
}
