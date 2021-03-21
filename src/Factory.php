<?php

declare(strict_types=1);

namespace tickerEvents;

use PDO;
use Slim\App;
use Slim\Factory\AppFactory;

class Factory
{
    public function createApp(): App
    {
        $app = AppFactory::create();

        return Router::setRoutes($app);
    }

    public static function createLiveTickerAction(): LiveTickerAction
    {
        return new LiveTickerAction(
            new FileLoader()
        );
    }

    public static function createBlankAction(): BlankAction
    {
        return new BlankAction();
    }

    public static function createEventConsumer(): Consumer
    {
        return new Consumer(
            new EventLoader(
                self::createPdoConnection()
            )
        );
    }

    public static function createEventEmitter(): Emitter
    {
        return new Emitter();
    }

    private static function createPdoConnection(): PDO
    {
        $mySqlConnector = new MySqlConnector();
        return $mySqlConnector->getConnection();
    }

    public static function createGetDefaultTickerEventsAction(): GetDefaultTickerEventsAction
    {
        return new GetDefaultTickerEventsAction(
            self::createEventConsumer()
        );
    }
}
