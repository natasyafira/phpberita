<?php 
    $conn = new mysqli("localhost", "root", "", "phpberita");
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
      }