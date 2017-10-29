<?php
$db=conn::db();
$select="SELECT method_id,controller_name,class_name,send_to FROM `nep_route_info` ORDER BY method_id DESC";
$prepare=$db->prepare($select);
if(!$prepare->execute())
{
    die("Server Error");
}
$data=$prepare->fetchAll();
?>
<style>
    td{
        padding:10px;
    }
</style>
<table border=3>
    <th>Method id</th>
    <th>Controller name</th>
    <th>Class name</th>
    <th>Send to</th>
<?php
    include("../Router/passkey.php");
    foreach($data as $row)
    {
        print("<tr>");
        print("<td>".$row['method_id']."</td>");
        print("<td><a href='../Router/route_settings/route_info.php?method_id=".$row['method_id']."' target='_blank'>".$row['controller_name']."</a></td>");
        print("<td>".$row['class_name']."</td>");
        print("<td><a href='../Router/?method_id=".$row['method_id']."&passkey=".$passkey."' target='_blank'>".$row['send_to']."</a></td>");
        print("</tr>");
    }
    ?>
</table>