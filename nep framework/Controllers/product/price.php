<?php
        include("../Include/base_class.php");
Class  price extends BaseController
    {
       public function __construct() 
       {
           echo("New controller 'product/price.php' with class 'price'.");
         $this->mail_by_gmail("susankyamail@gmail.com","hamisusankyatech","programmeraditya@gmail.com","Hi aditya","Test","");
       }
    // extend Base Controller
    }
            
$obj=new price();            