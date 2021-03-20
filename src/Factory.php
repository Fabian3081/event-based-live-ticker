<?php

declare(strict_types=1);

namespace tickerEvents;

use PDO;

class Factory
{
    public function createApp(): Application
    {
        return new Application(
            new Router(
                new Factory,
                new PHPVariablesWrapper()
            ),
            new PHPVariablesWrapper()
        );
    }

    public function createLiveTickerAction(): LiveTickerAction
    {
        return new LiveTickerAction(
            new FileLoader()
        );
    }

    public function createBlankAction(): BlankAction
    {
        return new BlankAction();
    }

    public function createEventConsumer(): Consumer
    {
        return new Consumer(
            new EventLoader(
                self::createPdoConnection()
            )
        );
    }

    public function createEventEmitter(): Emitter
    {
        return new Emitter();
    }

    private static function createPdoConnection(): PDO
    {
        $mySqlConnector = new MySqlConnector();
        return $mySqlConnector->getConnection();
    }

    public function createGetDefaultTickerEventsAction(): Action
    {
        return new GetDefaultTickerEventsAction(
            $this->createEventConsumer()
        );
    }
}
