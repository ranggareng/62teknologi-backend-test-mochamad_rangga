<?php

namespace App\Traits;

// This Trait would be added to all models that use UUID

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait HasUuid
{
    public function uuid(): UuidInterface
    {
        return Uuid::fromString($this->uuid);
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getIncrementing()
    {
        return false;
    }

    public static function findByUuidOrFail(UuidInterface $uuid): self
    {
        return static::where('id', $uuid->toString())->firstOrFail();
    }
}