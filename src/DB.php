<?php

namespace App;

class DB
{
    private static $instance;
    public \PDO $db;

    private function __construct() {
        $this->db = new \PDO('sqlite:fuel.db');
    }

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new self;
        }

        return self::$instance->db;
    }
}
