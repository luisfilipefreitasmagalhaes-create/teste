<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Todas As Reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container2 {
        background: rgba(255, 255, 255, 0.8);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 655px;
        margin: 0 auto;
        height: 655;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-reserva-button {
            background-color: #e1a122;
            width: 250px; /* Ajuste o valor conforme necessário */
            margin-top: 18px;
            padding: 18px;
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        .add-reserva-button:hover {
            background-color: #be830c;
        }

        .eliminar-button {
            background-color: #e74c3c;
            color: white;
            padding: 8px;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }

        .eliminar-button:hover {
            background-color: #c0392b;
        }

        body.modal-open {
            overflow: hidden;
        }

        button.modal-btn {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 5px;
            font-size: 16px;
        }

        button.modal-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container2">
        <h1>Reservas</h1>

        <table>
            <thead>
                <tr>
                    <th>Nome do Cliente</th>
                    <th>Data e Hora</th>
                    <th>Número de Pessoas</th>
                    <th>Ações</th>

                </tr>
            </thead>
            <tbody id="tabelaReservas">
            <?php
                include('connection.php');

                // Recuperar dados da tabela de reservas, ordenados pelo dia da reserva
                $sql = "SELECT * FROM reservas ORDER BY Dia ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Utilize a função date para formatar a data
                        $dataFormatada = date('d-m-Y', strtotime($row["Dia"]));
                        
                        echo "<tr>
                                <td>" . $row["nome"] . "</td>
                                <td>" . $dataFormatada . "  " . $row["Hora"] . "</td>
                                <td>" . $row["Numero_Pessoas"] . "</td>
                                <td><button class='eliminar-button' onclick='eliminarReserva(" . $row["ID_R"] . ")'>Eliminar</button></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma reserva encontrada</td></tr>";
                }

                $conn->close();
            ?>

            </tbody>
        </table>
        <div class="button-container">
            <button class="add-reserva-button" onclick="redirecionarParaGestaoReservas()">Adicionar Reserva</button>
            <button class="add-reserva-button" onclick="redirecionarParaGestaoMesas()">Voltar Mesas</button>
        </div>
    </div>

    <div id="modalConfirmacao" style="display: none; background-color: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; justify-content: center; align-items: center;">
        <div style="background-color: #fff; padding: 20px; border-radius: 8px; text-align: center;">
            <p>Tem certeza que deseja eliminar esta reserva?</p>
            <button class="modal-btn" onclick="confirmarEliminarReserva()">Sim</button>
            <button class="modal-btn" onclick="fecharModal()">Não</button>
        </div>
    </div>

    <script>
        // Função para redirecionar para a página de gestão de reservas
        function redirecionarParaGestaoReservas() {
            window.location.href = "addreservas.php";
        }

        // Função para redirecionar para a página de gestão de mesas
        function redirecionarParaGestaoMesas() {
            window.location.href = "mesas.php";
        }

        // Função para eliminar a reserva com modal de confirmação
        function eliminarReserva(idReserva) {
            // Atribua o ID da reserva ao modal
            document.getElementById("modalConfirmacao").setAttribute("data-id", idReserva);

            // Mostrar o modal de confirmação
            mostrarModal();
        }

        // Função para mostrar o modal de confirmação
        function mostrarModal() {
            document.getElementById("modalConfirmacao").style.display = "flex";
            document.body.classList.add("modal-open");
        }

        // Função para fechar o modal
        function fecharModal() {
            document.getElementById("modalConfirmacao").style.display = "none";
            document.body.classList.remove("modal-open");
        }

        // Função para confirmar a eliminação da reserva
        function confirmarEliminarReserva() {
            // Recupere o ID da reserva
            var idReserva = document.getElementById("modalConfirmacao").getAttribute("data-id");

            // Redirecionar para a página eliminar_reserva.php com o ID da reserva
            window.location.href = "eliminar_reserva.php?id=" + idReserva;
        }
    </script>
</body>
</html>