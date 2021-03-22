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

    public static function createNewTickerEventAction(): NewTickerEventAction
    {
        return new NewTickerEventAction(
            new FileLoader()
        );
    }

    public static function createPostIsAuthenticatedAction(): PostIsAuthenticatedAction
    {
        return new PostIsAuthenticatedAction(
            new UserLoader(
                self::createPdoConnection()
            )
        );
    }

    public static function createBlankAction(): BlankAction
    {
        return new BlankAction();
    }

    public static function createEventConsumer(): EventConsumer
    {
        return new EventConsumer(
            new EventLoader(
                self::createPdoConnection()
            )
        );
    }

    public static function createEventEmitter(): EventEmitter
    {
        return new EventEmitter(
            new EventWriter(
                self::createPdoConnection()
            )
        );
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

    public static function createPostDefaultTickerEventsAction(): PostDefaultTickerEventsAction
    {
        return new PostDefaultTickerEventsAction(
            self::createEventEmitter()
        );
    }
}
