<?php
include "proteger.php";
include('connection.php');
// Processar a solicitação de adição de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeCliente = $_POST["nomeCliente"];
    $data = $_POST["data"];
    $Hora = $_POST["Hora"];
    $numPessoas = $_POST["numPessoas"];

    // Inserir reserva no banco de dados
    $sqlReserva = "INSERT INTO reservas (nome, Dia, Hora, Numero_Pessoas) VALUES ('$nomeCliente', '$data', '$Hora', '$numPessoas')";

    if ($conn->query($sqlReserva) === TRUE) {
            header("Location: reservas.php");
            exit();
        } else {
            echo "Erro ao reservar: " . $conn->error;
        }
    }



$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - Adicionar Reservas</title>
    <link rel="stylesheet" href="style.css">
    <style>
 body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    max-width: 500px;
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

select {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
}

label {
    display: block;
    font-size: 18px;
    color: #555;
    margin-bottom: 10px;
}

input {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 18px;
}

.button-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.button-container button {
    flex: 1;
    margin-right: 10px;
}

button {
    background-color: #e1a122;
    color: white;
    padding: 18px;
    font-size: 20px;
    cursor: pointer;
    border: none;
    border-radius: 6px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #be830c;
}

/* Adicione estilos adicionais conforme necessário */

    </style>
</head>
<body>
<form id="reservaForm" action="addreservas.php" method="post">
        <h2>Adicionar Reserva</h2>

        <label for="nomeCliente">Nome do Cliente:</label>
        <input type="text" id="nomeCliente" name="nomeCliente" required>

        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>

        <label for="Hora">Hora:</label>
        <input type="time" id="Hora" name="Hora" required>

        <label for="numPessoas">Número de Pessoas:</label>
        <input type="number" id="numPessoas" name="numPessoas" required>

        <div class="button-container">
            <button type="submit">Adicionar Reserva</button>
            <button type="button" onclick="window.location.href='reservas.php'">Voltar</button>
        </div>
    </form>

</body>
</html>