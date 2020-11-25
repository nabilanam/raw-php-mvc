<?php
abstract class Model
{
    /** @var Database $db */
    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
