<?php

declare(strict_types=1);

namespace tickerEvents;

interface TickerEventData
{
    public function getMappedEventData(): array;
    public static function fromJSON(string $json): TickerEventData;
}
