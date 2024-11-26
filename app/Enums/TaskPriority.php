<?php

namespace App\Enums;

enum TaskPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

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

    public function messages()
    {
        return [
            'priority.enum' => 'The selected priority is invalid.',
        ];
    }
}
