<?php

declare(strict_types=1);

namespace tickerEvents;

use Slim\App;

class Router
{
    /**
     * @param App $app
     * @return App
     */
    public static function setRoutes(App $app): App
    {
        $app->get('/', Factory::createLiveTickerAction());
        $app->get('/getTickerEvents/DefaultTickerEvent/{lastEventID}',
            Factory::createGetDefaultTickerEventsAction()
        );

        return $app;
    }
}