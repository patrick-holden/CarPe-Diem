<?php

class Database // singleton
{
    private \PDO $pdo;

    private static ?Database $instance = null; // initialise the db with null using ?
    // ? allows the Database to be nullable. Ie it can be of type Database or type null

    private function __construct()
    {
        $host = 'db';
        $db = 'carsdb';
        $user = 'root';
        $pass = 'password';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ]; // The backslashes indicate that PDO is in the global namespace

        try {
            $this->pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $exception) {
            throw new \PDOException($exception->getMessage(), (int)$exception->getCode());
        }
    }

    // Lazy initialisation for singleton design pattern
    public static function getInstance(): Database
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // Getter for $pdo
    public function getConnection(): \PDO
    {
        return $this->pdo;
    }

}