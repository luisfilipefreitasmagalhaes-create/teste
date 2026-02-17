<?php
include "proteger.php";
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idReserva = $_GET["id"];

    // Recuperar o número da mesa associada à reserva (substitua 'nummesa' pela coluna correta)
    $sqlGetMesa = "SELECT * FROM reservas WHERE ID_R = $idReserva";
    $resultGetMesa = $conn->query($sqlGetMesa);

    if ($resultGetMesa->num_rows > 0) {
        $rowMesa = $resultGetMesa->fetch_assoc();

        // Execute a lógica para eliminar a reserva com base no $idReserva
        $sqlDeleteReserva = "DELETE FROM reservas WHERE ID_R = $idReserva";

        if ($conn->query($sqlDeleteReserva) === TRUE) {
                // Redirecionar de volta para a página de visualização de reservas após adicionar uma reserva
                header("Location: reservas.php");
                exit();
        }else {
            echo "Erro ao eliminar reserva: " . $conn->error;
        }
    } else {
        echo "Mesa não encontrada para a reserva.";
    }
$conn->close();
}
?>