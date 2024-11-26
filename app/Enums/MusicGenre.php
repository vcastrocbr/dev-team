<?php

namespace App\Enums;

enum MusicGenre: string
{
    case POP = 'Pop';
    case ROCK = 'Rock';
    case JAZZ = 'Jazz';
    case CLASSICAL = 'Classical';
    case HIP_HOP = 'Hip-hop';

    /**
     * Get the display name for the enum.
     */
    public function label(): string
    {
        return $this->value;
    }

    /**
     * Get all values as an associative array for use in forms, etc.
     */
    public static function options(): array
    {
        return [
            self::POP->value => self::POP->label(),
            self::ROCK->value => self::ROCK->label(),
            self::JAZZ->value => self::JAZZ->label(),
            self::CLASSICAL->value => self::CLASSICAL->label(),
            self::HIP_HOP->value => self::HIP_HOP->label(),
        ];
    }
    
    /**
     * Custom validation message for invalid enum value.
     */
    public function messages()
    {
        return [
            'genre.enum' => 'The selected genre is invalid.',
        ];
    }
}
