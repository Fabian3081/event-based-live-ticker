<?php

declare(strict_types=1);

namespace tickerEvents;

use PDO;
use PDOStatement;

class EventLoader
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
     * @param TickerEvent $tickerEvent
     * @param int $lastEventID
     * @return EventstoreEntry[]
     */
    public function loadEventstoreEntries(TickerEvent $tickerEvent, int $lastEventID = 0): array
    {
        $eventType = $tickerEvent->getTickerEventType();
        $loadedEvents = [];

        $statement = $this->getLoadEventsStatement();
        $statement->bindParam(":eventID", $lastEventID);
        $statement->bindParam(":eventType",$eventType);
        $statement->execute();
        $events = $statement->fetchAll();

        foreach ($events as $event) {
            $loadedEvents[] = new EventstoreEntry(
                (string) $event["tickerEventType"],
                (string) $event["tickerEventData"],
                (int) $event["tickerEventID"]
            );
        }

        return $loadedEvents;
    }

    /**
     * @return PDOStatement
     */
    private function getLoadEventsStatement(): PDOStatement
    {
        return $this->pdo->prepare(
            "SELECT tickerEventID, tickerEventType, tickerEventData FROM tickerEvents WHERE tickerEventID > :eventID AND tickerEventType = :eventType"
        );
    }
}
