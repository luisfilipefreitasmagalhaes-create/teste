<?php
include "proteger.php";
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $idprod = $_GET['produto'];
    $idmesa = $_GET['mesa'];
    
    // Delete o produto do pedido
    $sql_delete = "DELETE FROM pedidos WHERE ID_Produto = $idprod AND ID_Mesa = $idmesa AND Estado = 'A'";
    $result_delete = mysqli_query($conn, $sql_delete);

    if ($result_delete) {
        // Redirecionar para a página pedidos.php com o ID da mesa
        header("Location: pedidos.php?id=$idmesa");
        exit();
    } else {
        // Se houver um erro ao excluir o produto
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>