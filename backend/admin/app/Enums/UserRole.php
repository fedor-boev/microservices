<?php

namespace App\Enums;

enum UserRole
{
    case ADMIN;
    case EDITOR;
    case VIEWER;

    public function level(): string
    {
        return match($this)
        {
            self::ADMIN => 'Admin',
            self::EDITOR => 'Editor',
            self::VIEWER => 'Viewer',
        };
    }
}
