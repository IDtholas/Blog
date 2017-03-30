<?php

class Connexion
{
 protected $dbname;
 protected $dbuser;
 protected $dbhost;
 protected $dbpass;
 protected $db;

 public function __construct($nom, $user, $host, $pass)
 {
     $this->dbname = $nom;
     $this->dbuser = $user ;
     $this->dbhost = $host;
     $this->dbpass = $pass;
     $this->db = New PDO("mysql:host=$host;dbname=$nom", $user, $pass);
 }

 public function db()
 {
     return $this->db;
 }
}
?>