<!doctype html>
<?php
include("./create.php")
?>
<html>
    <head>
        <title>
        Setup
        </title>
    </head>
    <body>
<h1> Initial Setup</h1>
      
        <h2>Please type the username and password of your local MySql server.</h2>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <label for="username">username</label>
          <input name="username" type="text" placeholder="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>"/>
          <label for="password">password</label>
          <input name="password" type="password" placeholder="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];}?>"/>
          <input type="submit" name="submit" value="Go"/>
      </form>
    </body>
</html>
            
              <?php
          if(isset($_POST['submit']))
          {
              $username=$_POST['username'];
              $password=$_POST['password'];
              
              mysqli_connect("localhost",$username,$password) or die("Invalid Username and passowrd.");
              include("db_name.php");
          }
         ?>