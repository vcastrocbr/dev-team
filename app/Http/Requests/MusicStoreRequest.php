<?php

namespace App\Http\Requests;

use App\Enums\MusicGenre;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class MusicStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // In this case, you can always allow any authenticated user to create a music entry.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'genre' => ['required', new Enum(MusicGenre::class)],
            'file_path' => 'required|string|max:255',
        ];
    }
}
