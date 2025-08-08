<?php

namespace Splash\Models\Helpers;

class InlineHelper
{
    public static function fromArray(array $data): string
    {
        return implode(',', $data);
    }
}
