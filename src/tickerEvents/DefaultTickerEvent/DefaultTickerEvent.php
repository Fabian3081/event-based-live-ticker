<?php

declare(strict_types=1);

namespace tickerEvents;

class DefaultTickerEvent implements TickerEvent
{
    private ?int $tickerEventID;
    private string $tickerEventType;
    private TickerEventData $tickerEventData;

    public function __construct(
        TickerEventData $tickerEventData,
        int $tickerEventID = null
    ) {
        $this->tickerEventID = $tickerEventID;
        $this->tickerEventType = "DefaultTickerEvent";
        $this->tickerEventData = $tickerEventData;
    }

    public function getMappedEvent(): array
    {
        return [
            "tickerEventID" => $this->tickerEventID,
            "tickerEventType" => $this->tickerEventType,
            "tickerEventData" => $this->tickerEventData
                ->getMappedEventData()
        ];
    }

    /**
     * @return int
     */
    public function getTickerEventID(): int
    {
        return $this->tickerEventID;
    }

    /**
     * @return string
     */
    public function getTickerEventType(): string
    {
        return $this->tickerEventType;
    }

    /**
     * @return TickerEventData
     */
    public function getTickerEventData(): TickerEventData
    {
        return $this->tickerEventData;
    }

    /**
     * @param int|null $tickerEventID
     */
    public function setTickerEventID(?int $tickerEventID): void
    {
        $this->tickerEventID = $tickerEventID;
    }

    /**
     * @param TickerEventData $tickerEventData
     */
    public function setTickerEventData(TickerEventData $tickerEventData): void
    {
        $this->tickerEventData = $tickerEventData;
    }
}
