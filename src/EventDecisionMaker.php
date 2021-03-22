<?php

declare(strict_types=1);

namespace tickerEvents;

class EventDecisionMaker
{
    /**
     * @param string $eventType
     * @return TickerEvent
     * @throws NoMatchingEventTypeException
     */
    public static function getEventInstanceFromEventType(string $eventType): TickerEvent
    {
        $assignment = [
            "DefaultTickerEvent" => new DefaultTickerEvent(
                new DefaultTickerEventData()
            )
        ];

        if (!key_exists($eventType, $assignment)) {
            throw new NoMatchingEventTypeException('There is no matching Event Instance for "' . $eventType . '"');
        }

        return $assignment[$eventType];
    }
}
