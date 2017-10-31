<?php
include("../../Include/index.php");
$method_id=$_GET['method_id'];
$db=conn::db();
$select="SELECT controller_name,controller_description,class_name from nep_route_info WHERE method_id=:mid";
$prepare=$db->prepare($select);
if(!$prepare->execute(array(':mid'=>$method_id)))
{
    die("Server Error");
}
$data=$prepare->fetch();
$controller=$data['controller_name'];
$description=$data['controller_description'];
$class_name=$data['class_name'];


?>
<html> 
    <head>
        <title>
        <?php echo $controller;?>
        </title>
        <style>
            td{
                padding:5px;
            }
        </style>
    
    </head>
    <body>
        <div class="header">
        <h2>
            
            <?php echo "Method Id: ".$method_id."<br>".$controller; ?>
        </h2>
        </div>
        
        <div class="body">
            <b>Description:</b><br>
            <?php echo $description; ?>
            
            <div id="class_names">
                <b>Main class:</b><br>
                <?php echo $class_name; ?>

            </div>
            
          
            
            <div id="get_requests">
                <b>Get Requests:</b><br>
               <table border=3>
                <?php
                
                  $regex="/._[gG][eE][tT]\[[\"'].*[\"']\]/";
                $match = preg_grep($regex, file('../../Controllers/'.$controller));    
                   foreach($match as $td)
                {
                    print("<tr><td>".$td."</td></tr>");
                }
                   
                    ?>
                </table>
                
            </div>
            
              <div id="post_requests">
                <b>Post Requests:</b><br>
                <table border=3>
                <?php
                  $regex="/._[pP][oO][sS][tT]\[[\"'].*[\"']\]/";
                $match = preg_grep($regex, file('../../Controllers/'.$controller));    
               
                foreach($match as $td)
                {
                    print("<tr><td>".$td."</td></tr>");
                }
                   
                    ?>
                </table>
            </div>
             <div id="cookie_requests">
                <b>Cookie Requests:</b><br>
                <table border=3>
                <?php
                  $regex="/._[cC][oO][oO][kK][iI][eE]\[[\"'].*[\"']\]/";
                $match = preg_grep($regex, file('../../Controllers/'.$controller));    
               
                foreach($match as $td)
                {
                    print("<tr><td>".$td."</td></tr>");
                }
                   
                    ?>
                </table>
            </div>
            
            <div id="session_requests">
                <b>Session Requests:</b><br>
                <table border=3>
                <?php
                  $regex="/._[sS][eE][sS][sS][iI][oO][nN]\[[\"'].*[\"']\]/";
                $match = preg_grep($regex, file('../../Controllers/'.$controller));    
               
                foreach($match as $td)
                {
                    print("<tr><td>".$td."</td></tr>");
                }
                   
                    ?>
                </table>
            </div>
            
            
            
            <div id="methods">
            </div>
        </div>
        
    </body>
</html>