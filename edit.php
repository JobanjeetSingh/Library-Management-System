<?php include 'config.php';


  try {
    $connectionString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    $user = DBUSER;
    $pass = DBPASS;
    $pdo = new PDO($connectionString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "SELECT * FROM books WHERE id='$id';";
      $result = $pdo->query($query);
      $row = $result->fetch();
    }

    if (isset($_POST['newbookname'])==true ||isset($_POST['newauthorname'])==true|| isset($_POST['newloc'])==true|| isset($_POST['newyear'])==true) {
      $newbookname = $_POST['newbookname'];
      $newauthorname = $_POST['newauthorname'];
      $newloc = $_POST['newloc'];
      $newyear = $_POST['newyear'];
      $id = $_POST['id'];
      $query2 = "UPDATE books
                 SET bname='$newbookname',
                 aname='$newauthorname',
                 location='$newloc',
                 pyear='$newyear'
                 WHERE id = '$id';";
 $statement = $pdo->prepare($query2);
 $statement->bindValue(':newbookname', $_POST['newbookname']);
 $statement->bindValue(':newauthorname', $_POST['newauthorname']);
 $statement->bindValue(':newloc', $_POST['newloc']);
 $statement->bindValue(':newyear', $_POST['newyear']);
 $statement->execute();
 header('location:login_access.php');

  }


  } catch (\Exception $e) {
    echo "<p>Database is broken. What did you do?</p>";
    die($e->getMessage());

  }





 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Edit</title>
     <link rel="stylesheet" href="css/edit4.css">
   </head>
   <body>
     <form class="editform" action="edit.php" method="post">

       <div class="user-input">
         <label>Book Name</label>
         <input type="text" name="newbookname" value="<?php echo $row['bname']; ?>">
       </div>

       <div class="user-input">
         <label>Author Name</label>
         <input type="text" name="newauthorname" value="<?php echo $row['aname']; ?>">
       </div>

       <div class="user-input">
         <label>Location</label>
         <input type="text" name="newloc" value="<?php echo $row['location']; ?>">
       </div>

       <div class="user-input">
         <label>Published Year</label>
         <input type="text" name="newyear" value="<?php echo $row['pyear']; ?>">
       </div>
       <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

       <div class="user-input">
         <input type="submit" value="Save" class="btn">
       </div>


     </form>

   </body>
 </html>
