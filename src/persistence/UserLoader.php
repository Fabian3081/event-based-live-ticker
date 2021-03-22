<?php

declare(strict_types=1);

namespace tickerEvents;

use PDO;
use PDOStatement;

class UserLoader
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
     * @param string $username
     * @return string
     */
    public function loadPasswordHash(string $username): string
    {
        $statement = $this->getLoadUserByUsernameStatement();
        $statement->bindParam(":username", $username);
        $statement->execute();

        return $statement->fetch()["password"];
    }

    /**
     * @return PDOStatement
     */
    private function getLoadUserByUsernameStatement(): PDOStatement
    {
        return $this->pdo->prepare(
            "SELECT password FROM adminLogin WHERE name = :username"
        );
    }
}
