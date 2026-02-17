<?php
include "connection.php";

$str = "UPDATE `pedidos` SET `Estado`='F'WHERE `ID`=" . $_GET['id']; 
$result = mysqli_query($conn, $str);

header ("Location:cozinha.php");

mysqli_close($conn);
?>
