<?php 
  define("DB_SERVER", "localhost");
  define("DB_USER", "robby");
  define("DB_PASS", "password");
  define("DB_NAME", "myblog");

  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  //Test if connection succeeded
  if (mysqli_connect_errno()) {
    die("Database connection failed: " . 
       mysqli_connect_errno() . 
       " (" . mysqli_connect_errno() . " )"
       );
  }
 ?>