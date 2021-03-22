<?php

declare(strict_types=1);

namespace tickerEvents;

class EventEmitter
{
    private EventWriter $eventWriter;

    public function __construct(
        EventWriter $eventWriter
    ) {
        $this->eventWriter = $eventWriter;
    }

    /**
     * @param string $tickerEventType
     * @param string $tickerEventData
     * @return bool
     */
    public function emitEvent(string $tickerEventType, string $tickerEventData): bool
    {
        try {
            $newEvent = EventDecisionMaker::getEventInstanceFromEventType(
                (string) $tickerEventType
            );

            $newEvent->setTickerEventData(
                $newEvent->getTickerEventData()::fromJSON(
                    $tickerEventData
                )
            );

            $eventData = json_encode(
                $newEvent->getTickerEventData()->getMappedEventData()
            );

            return $this->eventWriter->writeEventstoreEntry(
                new EventstoreEntry(
                    $newEvent->getTickerEventType(),
                    $eventData
                )
            );
        } catch (NoMatchingEventTypeException $e) {
        // emit failed
        }
    }
}
