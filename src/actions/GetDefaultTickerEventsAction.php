<?php

declare(strict_types=1);

namespace tickerEvents;

class GetDefaultTickerEventsAction implements Action
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

    public function run(): string
    {
        $events = $this->consumer->loadAfter(
            new DefaultTickerEvent(
                new DefaultTickerEventData()
            ),
            0
        );

        $jsonEvents = [];

        foreach ($events as $event) {
            $jsonEvents[] = $event->getMappedEvent();
        }

        header('Content-Type: application/json');
        return json_encode($jsonEvents);
    }
}
