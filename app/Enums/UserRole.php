<?php

namespace App\Enums;

enum UserRole: int
{
    case STANDARD = 10;
    case SUPERVISOR = 30;
    case ADMIN = 50;

    /**
     * Get the display name for the enum.
     */
    public function label(): string
    {
        return match ($this) {
            self::STANDARD => 'Standard User',
            self::SUPERVISOR => 'Supervisor',
            self::ADMIN => 'Administrator',
        };
    }

    /**
     * Get all values as an associative array.
     */
    public static function options(): array
    {
        return [
            self::STANDARD->value => self::STANDARD->label(),
            self::SUPERVISOR->value => self::SUPERVISOR->label(),
            self::ADMIN->value => self::ADMIN->label(),
        ];
    }

    /**
     * Custom validation message for invalid enum value.
     */
    public function messages(): array
    {
        return [
            'role.enum' => 'The selected role is invalid.',
        ];
    }
}
