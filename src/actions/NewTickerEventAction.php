<?php

declare(strict_types=1);

namespace tickerEvents;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class NewTickerEventAction
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

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write($this->fileLoader->loadHTML("createTicker"));

        return $response
            ->withHeader('Content-type', ['text/html', 'charset=UTF-8'])
            ->withStatus(200);
    }
}
