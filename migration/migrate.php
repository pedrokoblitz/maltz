<?php

class Migrate
{
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = 'root';
    protected $dbOrigin = '';
    protected $dbDestiny = '';
    protected $origin;
    protected $destiny;

    public function __construct()
    {
        $origin = new PDO();
        $destiny = new PDO();
    }

    public function setList($values)
    {
        return '(' . implode(',', $values) . ')';
    }

    public function selectQuery($table, $fields)
    {
        return "SELECT {$fields} FROM {$table}";
    }

    public function insertQuery($table, $fields, $values)
    {
        return "INSERT INTO {$table} {$fields} VALUES {$values}";
    }

    public function query($db, $sql)
    {
        return $db->query($sql);
    }

    public function migrateFiles()
    {

    }

    public function migrateAlbums()
    {

    }

    public function migrateContent()
    {
        
    }

}
