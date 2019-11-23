<?php
require '../../config/db.php';
echo "hello";
$id=$_GET['id'];
echo $id;
$delete = "DELETE FROM add_service WHERE sid=$id";
$result = mysqli_query($link,$delete) or die(mysql_error());
header('location:services.php');
?>