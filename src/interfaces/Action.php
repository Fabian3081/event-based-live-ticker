<?php

declare(strict_types=1);

namespace tickerEvents;

interface Action
{
    public function run(): string;
}
