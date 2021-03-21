<?php

declare(strict_types=1);

namespace tickerEvents;

/**
 * @codeCoverageIgnore
 */
class PHPVariablesWrapper
{
    /**
     * @return string
     */
    public static function getEnvironment(): string
    {
        $environments = ["local", "production"];
        $env = getenv('ENV');

        if (!in_array($env, $environments)) {
            $env = $environments[0];
        }

        return $env;
    }
}
