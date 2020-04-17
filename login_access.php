<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Library</title>
    <link rel="stylesheet" href="css/main4.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>




        <script>
          $(function(){
            // Our code goes here
            $("#show").on("click", function(){
              // Toggle means show/hide
              $("form").removeClass("hidden");
              $("#show").addClass("hidebutton");
            });

          });
        </script>
  </head>
  <body>
    <h1>Welcome to Library</h1>
    <table>
      <thead>
        <tr>
          <th colspan="2">Book Name</th>
          <th colspan="2">Author Name</th>
          <th>Location</th>
          <th>Published year</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        session_start();
        if ($_SESSION["email"]==true) {
          echo "";
        }

        else {
          header('location:index.php');
        }


        try {
          $connectionString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
          $user = DBUSER;
          $pass = DBPASS;
          $pdo = new PDO($connectionString, $user, $pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query = "SELECT * FROM books;";
          $result = $pdo->query($query);



        } catch (\Exception $e) {
          echo "<p>Database is broken. What did you do?</p>";
          die($e->getMessage());
        }


        while($row = $result->fetch()){ ?>
          <tr>
            <td colspan="2"><?php echo $row['bname'] ?></td>
            <td colspan="2"><?php echo $row['aname'] ?></td>
            <td><?php echo $row['location'] ?></td>
            <td><?php echo $row['pyear'] ?></td>
            <td>
              <?php echo "<a href='delete.php?id=$row[id].'> Delete </a>"; ?>

            </td>
            <td>
              <?php echo "<a href='edit.php?id=$row[id].'> Edit</a>"; ?>


            </td>
          </tr>
        <?php } ?>
      </tbody>



    </table>

    <button type="button" name="showbutton" id="show">Add new Records</button>

    <form  action="server.php" method="post" class="hidden">
      <div class="user-input">
        <label>Enter a new book name:</label>
        <input type="text" name="bookname" required>
      </div>

      <div class="user-input">
        <label>Enter the author of book:</label>
        <input type="text" name="authorname" required>
      </div>

      <div class="user-input">
        <label>Enter the Location:</label>
        <input type="text" name="loc" required>
      </div>

      <div class="user-input">
        <label> Enter the Published Year:</label>
        <input type="text" name="year" required>
      </div>

      <div class="user-input">
        <button type="submit" class="btn"  value="Save">Save</button>
      </div>

    </form>
    <nav>
      <a href="logout.php">LogOut</a>
    </nav>
  </body>
</html>
