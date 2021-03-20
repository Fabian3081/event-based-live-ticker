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
    public function getRequestUri(): string
    {
        if (array_key_exists('REQUEST_URI', $_SERVER)) {
            $splitUrl = explode("/", $_SERVER['REQUEST_URI']);
            return "/" . end($splitUrl);
        }
        return '/';
    }

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
