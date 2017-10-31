         <?php
    $dbname="";
    if(isset($_GET['db_name']))
    {
        $dbname=trim($_GET['db_name']);
    }
    else if(isset($_POST['db_name']))
    {
        $dbname=trim($_POST['db_name']);
    }
    if($dbname!="")
    {
        $db=new PDO("mysql:host=localhost;charset=utf8;dbname=".$dbname,"root","");
    }