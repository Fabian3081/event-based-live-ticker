<?php

declare(strict_types=1);

namespace tickerEvents;

class EventstoreEntry
{
    private int $tickerEventID;
    private string $tickerEventType;
    private string $tickerEventData;

    public function __construct(
        int $tickerEventID,
        string $tickerEventType,
        string $tickerEventData
    ) {

        $this->tickerEventID = $tickerEventID;
        $this->tickerEventType = $tickerEventType;
        $this->tickerEventData = $tickerEventData;
    }

    /**
     * @return string
     */
    public function getTickerEventData(): string
    {
        return $this->tickerEventData;
    }

    /**
     * @return string
     */
    public function getTickerEventType(): string
    {
        return $this->tickerEventType;
    }

    /**
     * @return int
     */
    public function getTickerEventID(): int
    {
        return $this->tickerEventID;
    }
}
