<?php
if(isset($_POST['submit_db_name']))
{
 if(trim($_POST['db_name'])!="")
   {
$dbName="nep_".$_POST['db_name'];
     $username=$_POST['username'];
     $password=$_POST['password'];
     
     
     
//***************************************************************************************************8//
$file=fopen("./Include/index.php","w+");
     $text=<<<EndOfQuote
<?php
class conn
    {
public static function db()
 {
    
\$db=new PDO("mysql:host=localhost;charset=utf8;dbname=$dbName","$username","$password");
    include("multi_db.php");
\$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    \$db->query("SET NAMES 'utf8'");
return \$db;
}
    }
EndOfQuote;
    
     fwrite($file,$text);
     fclose($file);
  //********************************************************************************************//
    
//#################################################################################################//     
     $file=fopen("./Include/multi_db.php","w+");  
     $text=<<<EndOfQuote
         <?php
    \$dbname="";
    if(isset(\$_GET['db_name']))
    {
        \$dbname=trim(\$_GET['db_name']);
    }
    else if(isset(\$_POST['db_name']))
    {
        \$dbname=trim(\$_POST['db_name']);
    }
    if(\$dbname!="")
    {
        \$db=new PDO("mysql:host=localhost;charset=utf8;dbname=".\$dbname,"$username","$password");
    }
EndOfQuote;
     fwrite($file,$text);
     fclose($file);
     //#############################################################################################//
     
     
     $db=mysqli_connect("localhost",$username,$password) or die("Error");
     mysqli_query($db,"CREATE DATABASE ".$dbName." /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */")or die("Invalid Database Name <br><br>");
     mysqli_close($db);
     
     $db=mysqli_connect("localhost",$username,$password,$dbName) or die("Error");
     $create_table="CREATE TABLE `nep_route_info` (
 `method_id` int(11) NOT NULL AUTO_INCREMENT,
 `controller_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
 `controller_description` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
 `arguments` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
 `get_post` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
 `send_to` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
 `class_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
 PRIMARY KEY (`method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
   mysqli_query($db,$create_table) or die("Error");
    mysqli_close($db); 
   include("uninstall.php");//Developers are requested to comment this line.
   }
    else
    {
        die("Invalid database name please try again.");
    }
    echo("Database ".$dbName." created <br><br>");
}
?>