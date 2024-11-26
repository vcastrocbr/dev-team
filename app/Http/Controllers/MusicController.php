<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
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


    // Show the form for editing the specified music.
    public function edit(Music $music)
    {
        $tags = Tag::all();  // Get all tags for editing
        return view('pages.music.edit', compact('music', 'tags'));
    }


    // Show the form for creating a new music.
    public function create()
    {
        $tags = Tag::all();
        return view('pages.music.create', compact('tags'));
    }


    // Store a newly created music in the database.
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
            'file_path' => 'required|string|max:255',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        // Create a new music entry
        $music = Music::create([
            'title' => $validated['title'],
            'artist' => $validated['artist'],
            'genre' => $validated['genre'],
            'file_path' => $validated['file_path'],
        ]);

        // Attach selected tags to the music
        if (isset($validated['tags'])) {
            $music->tags()->attach($validated['tags']);
        }

        return redirect()->route('musics.index')->with('success', 'Music created successfully');
    }


    // Update the specified music in the database.
    public function update(Request $request, Music $music)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
            'file_path' => 'required|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        // Update the music details
        $music->update([
            'title' => $validated['title'],
            'artist' => $validated['artist'],
            'genre' => $validated['genre'],
            'file_path' => $validated['file_path'],
        ]);

        // Sync the selected tags to the music
        $music->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('musics.index')->with('success', 'Music updated successfully');
    }


    // Remove the specified music from the database.
    public function destroy(Music $music)
    {
        // Detach tags before deleting
        $music->tags()->detach();

        // Delete the music
        $music->delete();

        return redirect()->route('musics.index')->with('success', 'Music deleted successfully');
    }
}
