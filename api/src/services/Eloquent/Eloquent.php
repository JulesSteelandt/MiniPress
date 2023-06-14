<?php

namespace minipress\api\src\services\Eloquent;


class Eloquent
{
    public static function init(string $configPath): void
    {
        $db = new Manager();
        $db->addConnection(parse_ini_file($configPath));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}