<?php

namespace App\Enums;

enum RoleType: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case VIEWER = 'viewer';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::EDITOR => 'Editor',
            self::VIEWER => 'Viewer',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator with full access',
            self::EDITOR => 'Editor with content management access',
            self::VIEWER => 'Viewer with read-only access',
        };
    }
}
