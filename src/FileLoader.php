<?php

declare(strict_types=1);

namespace tickerEvents;

class FileLoader
{
    /**
     * @param string $filename
     * @return string
     */
    public function loadHTML(string $filename): string
    {
        return file_get_contents(__DIR__ . "/html/". $filename . ".html");
    }
}