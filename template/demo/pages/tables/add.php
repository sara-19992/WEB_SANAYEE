<?php
include "send_Notify.php";
//$phone = $_GET['phone'];
$db = new mysqli('localhost', 'root', '', 'sanaye');
if (mysqli_connect_errno()) {
    echo "could not connect with database";
    exit();
}
//Put this POST block right at the top of the page.
echo "could connect with database";
$phone=$_POST['phone'];
$sql1 = "select * from  request  WHERE `request`.`phone` = $phone";
$res1 = $db->query($sql1);
$row1 = mysqli_fetch_array($res1);
$name=$row1['name'];
$namefirst=$row1['namefirst'];
$namelast=$row1['namelast'];
$pass=$row1['pass'];
$phone=$row1['phone'];
$imagename=$row1['image'];
$ًWork=$row1['Work'];
$Experiance=$row1['Experiance'];
$Information=$row1['Information'];
$token=$row1['mytoken'];
$res2t=$db->query("INSERT INTO `worker` (`name`,`namefirst`, `namelast`, `pass` , `phone`, `image` , `Work` , `Experiance` , `Information` ,  `token`) VALUES ('$name','$namefirst' ,'$namelast', '$pass','$phone','$imagename','$ًWork','$Experiance','$Information','$token')");
$res3t=$db->query("DELETE FROM `request` WHERE `request`.`phone` = $phone");
$m="لقد تم قبولك في صنايعي ";
$token=$row1['token'];
$c=$name;
$massage=$c.$m;
sendGCM("صنايعي" ,$massage , $token , "1", "W");
header("Location: basic-tables.php");
exit;
?>

