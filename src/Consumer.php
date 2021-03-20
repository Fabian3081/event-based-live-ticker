<?php

declare(strict_types=1);

namespace tickerEvents;

class Consumer
{
    private EventLoader $eventLoader;

    public function __construct(
        EventLoader $eventLoader
    ) {
        $this->eventLoader = $eventLoader;
    }

    /**
     * @param TickerEvent $tickerEvent
     * @param int $lastEventID
     * @return TickerEvent[]
     */
    public function loadAfter(TickerEvent $tickerEvent, int $lastEventID = 0): array
    {
        $eventstoreEntries = $this->eventLoader->loadEventstoreEntries($tickerEvent, $lastEventID);
        $events = [];

        foreach ($eventstoreEntries as $eventstoreEntry) {
            try {
                if ($eventstoreEntry->getTickerEventType() === $tickerEvent->getTickerEventType()) {
                    $tickerEvent->setTickerEventID($eventstoreEntry->getTickerEventID());
                    $tickerEvent->setTickerEventData(
                        $tickerEvent->getTickerEventData()::fromJSON(
                            $eventstoreEntry->getTickerEventData()
                        )
                    );
                    $events[] = $tickerEvent;
                }
            } catch (InvalidEventDataException $e) {

            }
        }

        return $events;
    }
}
