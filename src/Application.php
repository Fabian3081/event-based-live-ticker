<?php

declare(strict_types=1);

namespace tickerEvents;

class Application
{
    /**
     * @var Router
     */
    private Router $router;
    /**
     * @var PHPVariablesWrapper
     */
    private PHPVariablesWrapper $variablesWrapper;

    /**
     * Application constructor.
     * @param Router $router
     * @param PHPVariablesWrapper $variablesWrapper
     */
    public function __construct(
        Router $router,
        PHPVariablesWrapper $variablesWrapper
    ) {
        $this->router = $router;
        $this->variablesWrapper = $variablesWrapper;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->router->getPageForUrl(
            $this->variablesWrapper->getRequestUri()
        )->run();
    }
}
