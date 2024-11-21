<?php 
session_start();
  define('SITEURL', 'http://localhost:8081/');
  define('LOCALHOST', 'mariadb');
  define('ROOT', 'occurence_user');
  define('PASSWORD', 'strongpassword');
  define('DATABASE', 'occurence_db');

  $conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE, 3306);

  if (!$conn) {
      die('Connection failed: ' . mysqli_connect_error());
  }
  $db_select = mysqli_select_db($conn, DATABASE);

  if (!$db_select) {
      die('Database selection failed: ' . mysqli_error($conn));
  }

?>
