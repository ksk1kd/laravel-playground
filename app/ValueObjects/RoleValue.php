<?php

namespace App\ValueObjects;

use App\Enums\RoleType;

class RoleValue
{
    public readonly string $name;
    public readonly string $description;

    public function __construct(string $name)
    {
        $roleType = RoleType::tryFrom($name);

        if ($roleType === null) {
            throw new \InvalidArgumentException("Invalid role name: {$name}");
        }

        $this->name = $name;
        $this->description = $roleType->description();
    }
}
