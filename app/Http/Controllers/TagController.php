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
        // Validate the tag name
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags', 'name')->where(function ($query) use ($request) {
                    return $query->whereRaw('LOWER(name) = ?', [Str::lower($request->name)]);
                })
            ],
        ]);

        // Create the tag
        $tag = Tag::create([
            'name' => ucfirst($request->name,)
        ]);

        // Return the new tag as JSON
        return response()->json($tag);
    }
}
