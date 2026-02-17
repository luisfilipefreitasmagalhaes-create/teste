<?php
include "proteger.php";
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idprod = $_POST['Id_produto'];
    $idmesa = $_POST['idmesa'];

     $sql = "UPDATE `pedidos` 
            SET `Estado` = 'C' 
            WHERE `ID_Mesa` = $idmesa 
            AND `Estado` = 'A'";
           // echo $sql;
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_affected_rows($conn) > 0) {
        header("Location: mesas.php");
    } else {
        echo "Error updating records: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
