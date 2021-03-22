<?php

declare(strict_types=1);

namespace tickerEvents;

use PDO;
use PDOStatement;

class EventWriter
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param EventstoreEntry $eventstoreEntry
     * @return bool
     */
    public function writeEventstoreEntry(EventstoreEntry $eventstoreEntry): bool
    {
        $tickerEventType = $eventstoreEntry->getTickerEventType();
        $tickerEventData = $eventstoreEntry->getTickerEventData();

        $statement = $this->getLoadEventsStatement();
        $statement->bindParam(":tickerEventType",$tickerEventType);
        $statement->bindParam(":tickerEventData", $tickerEventData);
        return $statement->execute();
    }

    /**
     * @return PDOStatement
     */
    private function getLoadEventsStatement(): PDOStatement
    {
        return $this->pdo->prepare(
            "INSERT INTO tickerEvents (tickerEventType, tickerEventData) VALUES (:tickerEventType, :tickerEventData)"
        );
    }
}
