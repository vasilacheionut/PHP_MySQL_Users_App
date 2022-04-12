<?php

class Database extends mysqli
{
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  public function __construct()
  {
    $this->init_connection();
  }

  public function init_connection()
  {
    $this->conn = null;
    $this->servername = SERVERNAME;
    $this->username   = USERNAME;
    $this->password   = PASSWORD;
    $this->dbname     = DBNAME;

    // Connection to MySQL server
    $this->conn = new mysqli($this->servername, $this->username, $this->password);

    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
    $this->conn->query($sql);

    // Connection to MySQL server and Database
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

    // Check connection
    if ($this->connect_error) {
      die("Connection failed : " . $this->connect_error);
    }

    return $this->conn;
  }

  public function close_connection()
  {
    return $this->conn->close();
  }

  public function run_query($sql = '')
  {
    $this->conn->query($sql);
    return $this->conn->affected_rows;
  }

  function run_multi_query($query)
  {
    if ($this->conn->multi_query($query)) {
      do {
        if ($result = $this->conn->store_result()) {
          while ($row = $result->fetch_row()) {
          }
          $result->free();
        }
      } while ($this->conn->next_result());
    } else {
      return "SQL : error...";
    }
  }

  function run_sql_file($path, $file)
  {
    $query = file_get_contents($path . '/' . $file, true);
    if ($this->run_multi_query($query)) {
    } else {
      return "SQL : " . $file . " : error...";
    }
  }

  public function result_array($sql = '')
  {
    $result = $this->conn->query($sql);
    if ($result != null) {
      // output data of each row
      $data = [];
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    } else {
      $data[] = "";
    }
    return $data;
  }
}
