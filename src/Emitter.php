<?php

declare(strict_types=1);

namespace tickerEvents;

class Emitter
{
    private TickerEvent $tickerEvent;

    public function emitEvent(
        TickerEvent $tickerEvent
    ) {
        $this->tickerEvent = $tickerEvent;
    }
}
