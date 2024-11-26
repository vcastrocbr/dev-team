<?php

namespace App\Enums;

enum TaskPriority: int
{
    case LOW = 100;
    case MEDIUM = 300;
    case HIGH = 500;

    /**
     * Get the display name for the enum.
     */
    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }

    /**
     * Get all values as an associative array.
     */
    public static function options(): array
    {
        return [
            self::LOW->value => self::LOW->label(),
            self::MEDIUM->value => self::MEDIUM->label(),
            self::HIGH->value => self::HIGH->label(),
        ];
    }

    /**
     * Custom validation message for invalid enum value.
     */
    public function messages()
    {
        return [
            'priority.enum' => 'The selected priority is invalid.',
        ];
    }
}
