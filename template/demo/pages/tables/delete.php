<?php
include "send_Notify.php";
$db = new mysqli('localhost', 'root', '', 'sanaye');
if (mysqli_connect_errno()) {
    echo "could not connect with database";
    exit();
}
echo "could connect with database";
$phone=$_POST['phone'];
$sql2 = "select * from  request  WHERE `request`.`phone` = $phone";
$res2 = $db->query($sql2);
$row1 = mysqli_fetch_array($res2);
$c=$row1['name'];
$m="لقد تم رفض طلب انضمامك في صنايعي ";
$token=$row1['token'];
$sql1 = "DELETE FROM `request` WHERE `request`.`phone` = $phone";
$res1 = $db->query($sql1);
$massage=$c.$m;
sendGCM("صنايعي" ,$massage , $token , "1", "W");
header("Location: basic-tables.php");
exit;
?>
