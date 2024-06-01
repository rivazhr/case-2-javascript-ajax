<?php

class Model
{
  public function connect()
  {
    $host = 'localhost';
    $user = 'root';
    $password = 'rifa';
    $database = 'pemweb';

    $mysqli = new mysqli($host, $user, $password, $database);

    if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
    }

    return $mysqli;
  }
}
