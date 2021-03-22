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
        $app->get('/createTicker', Factory::createNewTickerEventAction());

        $app->get('/getTickerEvents/DefaultTickerEvent/{lastEventID}',
            Factory::createGetDefaultTickerEventsAction()
        );

        $app->post('/createTicker',
            Factory::createPostDefaultTickerEventsAction()
        );
        $app->post('/isAuthenticated',
            Factory::createPostIsAuthenticatedAction()
        );

        return $app;
    }
}