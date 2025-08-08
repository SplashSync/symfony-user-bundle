<?php

namespace Splash\Client;

use Splash\Core\Components\Logger;

class Splash
{
    public static function log(): Logger
    {
        return new Logger();
    }
}
