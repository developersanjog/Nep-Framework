<?php
$username='root';
$password='root';


if (!isset($_SERVER['PHP_AUTH_USER']) ||
    !isset( $_SERVER['PHP_AUTH_PW']) ||
    ($_SERVER['PHP_AUTH_USER'] !=$username) || ($_SERVER['PHP_AUTH_PW'] !=$password)) {
// The user name/password are incorrect so send the authentication headers
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Admin Panel"');
    exit('<font color="red"><h2>Susankya</h2>Sorry, you must enter a valid user name and password to ' .
        'access this page.');
}
?>
<html>
    <head>
        <title>
        Homepage-Create Controller
        </title>
    </head>
    <style>
        input,textarea{
            margin:5px;
        }
    </style>
    <body>
<h1> Create Controller</h1>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <label for="controller_name">Controller Name: </label>
          <input name="controller_name" type="text" placeholder="e.g clothes or products/goods"/>
          <br>
          <label for="controller_name">Main Class: </label>
          
          <input name="class_name" type="text" placeholder="Class Name"/>
          <br>
          <textarea rows="5" cols="20" name="description" placeholder="Controller Description"></textarea>
          <br>
          <input type="submit" name="submit_controller" value="Create"/>
      </form>
  
<?php
include("../Include/index.php");
            function create_folder_if_not_exists($controller)
            {
                $array=explode("/",$controller);
                $count=count($array);
                $path="../Controllers";
                $path_prefix="../";
                for($i=0;$i<$count-1;$i++)
                {
                    $path=$path."/".$array[$i];
                    $path_prefix=$path_prefix."../";
                    if (!file_exists($path))
                    {
                        mkdir($path, 0777, true);
            
                    }
                }
                return $path_prefix;
            }
            
    
    if(isset($_POST['submit_controller']))
    {
        if(trim($_POST['controller_name'])!="")
        {
            $array=explode("/",trim($_POST['controller_name']));
            $class_name=trim($_POST['class_name']);
            if($class_name==""){$class_name=end($array);}
            
            $controller=trim($_POST['controller_name']).".php";
            
            $description=trim($_POST['description']);
            
            $path_prefix=create_folder_if_not_exists($controller);
            
            $file=fopen("../Controllers/".$controller,'w+');
	$create_class=<<<EndOfQuote
<?php
        include("../Include/base_class.php");
Class  $class_name extends BaseController
    {
       public function __construct() 
       {
           echo("New controller '$controller' with class '$class_name'.");
       }
    // extend Base Controller
    }
            
\$obj=new $class_name();            
EndOfQuote;

	fwrite($file,$create_class);
		fclose($file);
            $db=conn::db();
            $insert="INSERT INTO `nep_route_info` (`method_id`, `controller_name`, `controller_description`, `arguments`, `get_post`, `send_to`, `class_name`) VALUES (NULL, '$controller','$description', '', '', 'router', '$class_name')";
           // die($insert);
            $prepare=$db->prepare($insert);
            if(!$prepare->execute()){
                die("Server Error");
                }
        echo ("Controller '$controller' created.<br>");    
        
        
        
        
        
        
        }
    }
?>
     <div class="route information">
<?php
         include("../Router/route_settings/index.php");
?>
     </div>        
       
    </body>
</html>