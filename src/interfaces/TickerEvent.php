<?php

declare(strict_types=1);

namespace tickerEvents;

interface TickerEvent
{
    public function __construct(TickerEventData $tickerEventData, int $tickerEventID = null);

    public function getMappedEvent(): array;

    public function getTickerEventID(): int;
    public function getTickerEventType(): string;
    public function getTickerEventData(): TickerEventData;

    public function setTickerEventID(int $tickerEventID): void;
    public function setTickerEventData(TickerEventData $tickerEventData): void;
}
