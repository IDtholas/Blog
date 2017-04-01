<?php

class Connexion
{
 protected $dbname = 'blog';
 protected $dbuser = 'root';
 protected $dbhost = 'localhost';
 protected $dbpass = '';
 protected $db;

 public function __construct()
 {
     $nom = $this->dbname;
     $user = $this->dbuser;
     $host = $this->dbhost;
     $pass = $this->dbpass;
     $this->db = New PDO("mysql:host=$host;dbname=$nom", $user, $pass);
 }

 public function db()
 {
     return $this->db;
 }
}