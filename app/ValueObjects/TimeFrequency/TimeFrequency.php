<?php

namespace App\ValueObjects\TimeFrequency;

use App\ValueObjects\ValueObject;

final class TimeFrequency implements ValueObject
{
    private function __construct(private string $frequency)
    {
    }

    public static function makeMonthly(): TimeFrequency
    {
        return new TimeFrequency('MONTHLY');
    }

    public static function makeWeekly(): TimeFrequency
    {
        return new TimeFrequency('WEEKLY');
    }

    public function getFrequency()
    {
        return $this->frequency;
    }

    public function isNull(): bool
    {
        return $this->getFrequency() === null;
    }

    public function isSame(ValueObject $object): bool
    {
        if ($object->getFrequency() === $this->getFrequency()) {
            return true;
        }
        return false;
    }

    public static function fromNative($native)
    {
        // TODO: Implement fromNative() method.
    }

    public function toNative()
    {
        // TODO: Implement toNative() method.
    }
}
