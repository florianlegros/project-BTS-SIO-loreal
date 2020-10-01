<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Bdd{
    public $con;

    function __construct(){
        require 'config.php';
        $this->con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if ($this->con->connect_error) {
            exit('Failed to connect to MySQL: ');
        }
    }

    function select($col, $tab, $condition){
        require 'config.php';
        $result = $this->con->prepare("SELECT $col FROM $tab $condition") or die(mysqli_error($this->con)); 
        return $result;
    }
    
    function insert($tble, $cols, $values){
        require 'config.php';
        $result = $this->con->prepare("INSERT INTO $tble ($cols) VALUES ($values)") or die(mysqli_error($this->con));
        return $result;
    }

    function update($tble, $value, $condtion){
        require 'config.php';
        $result = $this->con->prepare("UPDATE $tble SET $value $condtion") or die(mysqli_error($this->con));
        return $result;
    }

        
}