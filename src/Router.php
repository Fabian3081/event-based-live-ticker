<?php

declare(strict_types=1);

namespace tickerEvents;

class Router
{
    /**
     * @var Factory
     */
    private Factory $factory;
    /**
     * @var PHPVariablesWrapper
     */
    private PHPVariablesWrapper $variablesWrapper;

    /**
     * Router constructor.
     * @param Factory $factory
     * @param PHPVariablesWrapper $variablesWrapper
     */
    public function __construct(
        Factory $factory,
        PHPVariablesWrapper $variablesWrapper
    ) {
        $this->factory = $factory;
        $this->variablesWrapper = $variablesWrapper;
    }

    /**
     * @param string $url
     * @return Action
     */
    public function getPageForUrl(string $url): Action
    {
        switch ($url) {
            case '/':
                return $this->factory->createLiveTickerAction();
            case '/getDefaultTickerEvents':
                return $this->factory->createGetDefaultTickerEventsAction();
        }

        return $this->factory->createBlankAction();
    }
}