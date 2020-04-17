<?php

include 'config.php';

try {
  $connectionString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
  $user = DBUSER;
  $pass = DBPASS;
  $pdo = new PDO($connectionString, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "DELETE  FROM books WHERE id = '$_GET[id]';";
  $result = $pdo->query($query);

  if ($result == true) {
    header("location:login_access.php");
  }
  else {
    echo "Not Deleted";
  }
} catch (\Exception $e) {
  echo "<p>Database is broken. What did you do?</p>";
  die($e->getMessage());
}


 ?>
