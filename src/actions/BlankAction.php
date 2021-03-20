<?php

declare(strict_types=1);

namespace tickerEvents;

class BlankAction implements Action
{
    public function run(): string
    {
        return "blank";
    }
}
