<?php

namespace App\Casts;

use App\Enums\RoleType;
use App\ValueObjects\RoleValue;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class RoleCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?RoleValue
    {
        if (!isset($attributes['name'])) {
            return null;
        }

        return new RoleValue($attributes['name']);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        if (!$value instanceof RoleValue) {
            throw new \InvalidArgumentException('The given value must be a RoleValue instance.');
        }

        return [
            'name' => $value->name,
            'description' => $value->description,
        ];
    }
}
