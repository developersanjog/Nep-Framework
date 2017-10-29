<?php
class conn
    {
public static function db()
 {
    
$db=new PDO("mysql:host=localhost;charset=utf8;dbname=nep_eshop","root","");
    include("multi_db.php");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $db->query("SET NAMES 'utf8'");
return $db;
}
    }