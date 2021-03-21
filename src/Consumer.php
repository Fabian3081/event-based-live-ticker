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
        $failedEvents = [];

        foreach ($eventstoreEntries as $eventstoreEntry) {
            try {
                if ($eventstoreEntry->getTickerEventType() === $tickerEvent->getTickerEventType()) {
                    $tickerEvent->setTickerEventData(
                        $tickerEvent->getTickerEventData()::fromJSON(
                            $eventstoreEntry->getTickerEventData()
                        )
                    );
                    $tickerEvent->setTickerEventID($eventstoreEntry->getTickerEventID());
                    $events[] = clone($tickerEvent);
                }
            } catch (InvalidEventDataException $e) {
                $failedEvents[] = $eventstoreEntry->getTickerEventID();
            }
        }

        return $events;
    }
}
