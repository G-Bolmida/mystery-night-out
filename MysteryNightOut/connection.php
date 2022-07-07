<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  // If moving web hosts credentials below need to be updated for database communication
  $servername = "mysterydb";
  $username = "root";
  $password = "admin";
  $db_name = "mystery";
  // Create connection with DB
  $conn = new mysqli($servername, $username, $password, $db_name);
  // Check connection with DB
  if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }
?>