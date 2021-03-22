<?php

declare(strict_types=1);

namespace tickerEvents;

use PDO;

class MySqlConnector
{
    /**
     * @var PDO
     */
    private PDO $connection;

    public function __construct()
    {
        $config = [
            "user" => Config::getValue("tickerEventstoreDbUser"),
            "password" => Config::getValue("tickerEventstoreDbPassword"),
            "host" => Config::getValue("tickerEventstoreDbHost"),
            "dbName" => Config::getValue("tickerEventstoreDbName")
        ];
        $database = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbName'];
        $connection = new PDO($database, $config['user'], $config['password']);
        $this->connection = $connection;
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
