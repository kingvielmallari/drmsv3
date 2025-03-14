<?php

    class class_model {
        public $host = "localhost";
        public $user = "root";
        public  $pass = "";
        public  $dbname = "practice";
        public mysqli $mysqli;


        public function __construct() {
            $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

            if ($this->mysqli->connect_error) {
                die("Connection failed: " . $this->mysqli->connect_error);
            }
        }
    }


    
?>