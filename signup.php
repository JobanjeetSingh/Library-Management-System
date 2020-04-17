<?php
include 'config.php';

   if ($_SERVER['REQUEST_METHOD']== 'POST') {
      if (isset($_POST["email"])==true) {
          $email = $_POST["email"];

          if (preg_match('#^(.+)@([^\.].*)\.([a-z]{2,})$#',$email)) {
            $errormail = "";
          }

          else {
            $errormail = "Please enter a valid email";
          }
      }

      if (isset($_POST["pass"])==true) {

        $password = $_POST["pass"];
        if (strlen($password)>=8) {
          $errorPass = "";
        }

        else {
          $errorPass = "Please enter atleast 8 characters of password";

        }

        try {

          $connectionString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
          $user = DBUSER;
          $pass = DBPASS;
          $pdo = new PDO($connectionString, $user, $pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $email = $_POST['email'];
          $password = $_POST['pass'];
          $query = "SELECT Email FROM users WHERE Email = '{$email}';";
          $result = $pdo->query($query);
          $row = $result->fetch();


          if ($errormail == "" && $errorPass== "" && $row['Email'] != $email) {
            $query = "INSERT INTO users (Email,Password) VALUES (:email, :pass);";

            $statement = $pdo->prepare($query);
            $statement->bindValue(':email', $_POST['email']);
            $statement->bindValue(':pass', $_POST['pass']);
            $statement->execute();
            echo "<script type='text/javascript'>
                            alert('SignUp Sucessfull. Click on Login button to login');
                            </script>";
          }

          else if ($errormail == "" && $errorPass == "" && $row['Email'] == $email) {
            echo "<script type='text/javascript'>
                            alert('Sorry this email is already taken');
                            </script>";
          }



          else {
            echo "<script type='text/javascript'>
                       alert('please enter valid email or password');
                            </script>";
          }

          $pdo = null;

        }
        catch (Exception $e) {
          echo "<p>Database is broken. What did you do?</p>";
          die($e->getMessage());
        }

      }

   }
 ?>


  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>SignUps</title>
      <link rel="stylesheet" href="css/signup4.css">
    </head>
    <body>

      <form  action="signup.php" method="post" class="signup">
        <h1>SignUp</h1>
     <input type="text" name="email" placeholder="Email" data-validation="email" required>
     <input type="password" name="pass" placeholder="Password(minimun 7 characters)" data-validation="password" required><br><br>
     <input type="submit" value="SignUp">
      </form>
      <nav>
        <a href="index.php">Login here</a>
      </nav>

    </body>
  </html>
