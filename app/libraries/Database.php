<?php

class Database
{
    /** @var PDO $conn */
    private $conn;

    /** @var PDOStatement|bool $stmt */
    private $stmt;

    public function __construct()
    {
        try {
            $this->conn = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USERNAME,
                DB_PASSWORD,
                [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($statement)
    {
        $this->stmt = $this->conn->prepare($statement);

        return $this;
    }

    public function bind($param, $value, $type)
    {
        $this->stmt->bindValue($param, $value, $type);

        return $this;
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function get()
    {
        $this->execute();

        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $this->execute();

        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
