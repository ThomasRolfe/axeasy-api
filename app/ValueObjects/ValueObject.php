<?php

namespace App\ValueObjects;

interface ValueObject
{
    public function isNull(): bool;
    public function isSame(ValueObject $object): bool;
    public static function fromNative($native);
    public function toNative();
}
