<?php
include 'config.php';

session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(isset($_POST['email']) && isset($_POST['pass'])){
    try {
        $connectionString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $user = DBUSER;
        $pass = DBPASS;
        $pdo = new PDO($connectionString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $email = $_POST['email'];
        $password = $_POST['pass'];
        $_SESSION['email']=$email;
        $query = "SELECT * FROM users WHERE Email = '$email' and Password = '$password';";
        $result = $pdo->query($query);
        $row = $result->fetch();
        if ($row['Email'] == $email && $row['Password']== $password) {
          $_SESSION['email'] = $email;
          header("location:login_access.php");


        }

        else {
          echo "<script type='text/javascript'>
                          alert('Please enter a valid email or Password. Move back and try again');
                          </script>";


        }



    } catch (\Exception $e) {

        echo "<p>Database is broken. What did you do?</p>";
        die($e->getMessage());

    }


  }

}
 ?>
