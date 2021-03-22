<?php

declare(strict_types=1);

namespace tickerEvents;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostDefaultTickerEventsAction
{
    /**
     * @var EventEmitter
     */
    private EventEmitter $emitter;

    public function __construct(
        EventEmitter $emitter
    ) {
        $this->emitter = $emitter;
    }

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $post = json_decode($request->getBody()->getContents(), true);

        $tickerEventType = $post["tickerEventType"];
        $tickerEventData = json_encode($post["tickerEventData"]);

        if ($this->validateInput($tickerEventType, $tickerEventData)) {
            $this->emitter->emitEvent($tickerEventType, $tickerEventData);

            return $response
                ->withStatus(200);
        }

        return $response
            ->withStatus(422);
    }

    private function validateInput($tickerEventType, $tickerEventData): bool
    {
        if (is_string($tickerEventType) && is_string($tickerEventData)) {
            return true;
        }
        return false;
    }
}
