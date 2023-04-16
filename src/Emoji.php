<?php

declare(strict_types=1);

namespace PreemStudio\CommonMarkEmoji;

use Illuminate\Support\Str;
use Spatie\Emoji\Emoji as Spatie;
use TypeError;

final class Emoji
{
    public static function getCharacter(string $characterName): string
    {
        $result = \constant(Spatie::class.'::CHARACTER_'.\mb_strtoupper(Str::snake($characterName)));

        if (\is_string($result)) {
            return $result;
        }

        throw new TypeError('Character is not a string.');
    }

    public static function dataset(): array
    {
        return collect(Spatie::all())
            ->map(fn (string $value, string $key) => [\mb_strtolower(\mb_substr($key, 10)), $value])
            ->values()
            ->toArray();
    }
}
