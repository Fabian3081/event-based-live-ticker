<?php

declare(strict_types=1);

namespace tickerEvents;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GetDefaultTickerEventsAction
{
    /**
     * @var Consumer
     */
    private Consumer $consumer;

    public function __construct(
        Consumer $consumer
    ) {
        $this->consumer = $consumer;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $events = $this->consumer->loadAfter(
            new DefaultTickerEvent(
                new DefaultTickerEventData()
            ),
            (int) $args["lastEventID"]
        );

        $jsonEvents = [];

        foreach ($events as $event) {
            $jsonEvents[] = $event->getMappedEvent();
        }

        $response->getBody()->write(json_encode($jsonEvents));

        return $response
            ->withHeader('Content-type', ['application/json', 'charset=UTF-8'])
            ->withStatus(200);
    }
}
