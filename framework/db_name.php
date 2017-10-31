<html>
    <head>
        <title>
        Final Step
        </title>
    </head>
    <body>
    <h2>Enter Database Name [Letters,numbers and underscores only]</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <label for="db_name">Database Name</label>
          <input name="db_name" type="text" placeholder="db-name"/>
          <input name="username" type="hidden" value="<?php echo $_POST['username'];?>"/>
          <input name="password" type="hidden" value="<?php echo $_POST['password'];?>"/>
          <input type="submit" name="submit_db_name" value="Go"/>
      </form>
    </body>
</html>