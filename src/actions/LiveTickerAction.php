<?php

declare(strict_types=1);

namespace tickerEvents;

class LiveTickerAction implements Action
{
    /**
     * @var FileLoader
     */
    private FileLoader $fileLoader;

    public function __construct(
        FileLoader $fileLoader
    ) {
        $this->fileLoader = $fileLoader;
    }

    public function run(): string
    {
        return $this->fileLoader->loadHTML("liveTicker");
    }
}
