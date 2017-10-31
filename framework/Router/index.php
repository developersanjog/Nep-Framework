<?php
include('../Include/index.php');
include("passkey.php");

if(isset($_GET['method_id']) and isset($_GET['passkey']))
{
    $route_to=$_GET['method_id'];
    if($passkey!=trim($_GET['passkey'])){
      die("Unauthorized access");   
    }   

}
else if(isset($_POST['method_id']) and isset($_POST['passkey']))
{
      if($passkey!=trim($_POST['passkey']))
      {
          
      die("Unauthorized access");   
      
      } 
    $route_to=$_POST['method_id'];
}
else{
    
    die("Unauthorized access");
}

$db=conn::db();
$select_stmt="select controller_name from nep_route_info where method_id=$route_to";
$stmt_prepare=$db->prepare($select_stmt);
$stmt_prepare->execute();
$array=$stmt_prepare->fetch();
$page_name=$array['controller_name'];
include('../Controllers/'.$page_name);


?>