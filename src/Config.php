<?php

declare(strict_types=1);

namespace tickerEvents;

use DanielNess\Ansible\Vault\Decrypter;

class Config
{
    public static function getValue(string $key)
    {
        $config = require(__DIR__ . '/../config/config.' . self::getEnv() . '.php');
        return $config[$key];
    }

    private static function getEnv(): string
    {
        $environments = ["local", "production"];

        return $environments[0]; // TODO
    }
}
