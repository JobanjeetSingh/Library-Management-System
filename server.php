<?php
include 'config.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
  if (isset($_POST['bookname']) || isset($_POST['authorname']) || isset($_POST['loc'])|| isset($_POST['year'])) {
    try {
      $connectionString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
      $user = DBUSER;
      $pass = DBPASS;
      $pdo = new PDO($connectionString, $user, $pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $bookname = $_POST['bookname'];
      $authorname = $_POST['authorname'];
      $loc = $_POST['loc'];
      $year = $_POST['year'];
      $query = "INSERT INTO books (bname,aname,location,pyear) VALUES (:bookname, :authorname, :loc, :year);";
      $statement = $pdo->prepare($query);
      $statement->bindValue(':bookname', $_POST['bookname']);
      $statement->bindValue(':authorname', $_POST['authorname']);
      $statement->bindValue(':loc', $_POST['loc']);
      $statement->bindValue(':year', $_POST['year']);
      $statement->execute();
      header('location:login_access.php');



    }




     catch (\Exception $e) {
      echo "<p>Database is broken. What did you do?</p>";
      die($e->getMessage());

    }

    // code...
  }



}



 ?>
