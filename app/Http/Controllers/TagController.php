<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Normalize the name to have the first letter capitalized (keeping case-sensitive)
        $normalizedName = ucfirst(Str::lower($request->name));

        // Manually check if a tag with the same name exists (case-sensitive)
        $existingTag = Tag::where('name', $normalizedName)->first();

        if ($existingTag) {
            // If tag already exists, return a custom JSON error message
            return response()->json(['error' => 'Tag name already exists.'], 422);
        }

        // Create the tag
        $tag = Tag::create([
            'name' => $normalizedName,
        ]);

        // Return the new tag as JSON
        return response()->json($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
