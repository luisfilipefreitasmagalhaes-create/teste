<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - Visualizar Reservas</title>
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

        button.modal-btn {
            background-color: #e1a122;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 5px;
            font-size: 16px;
        }

        button.modal-btn:hover {
            background-color: #be830c;
        }
    </style>
</head>
<body>
    <div class="container2">
        <h1>Reservas Do Dia</h1>

        <table>
            <thead>
                <tr>
                    <th>Nome do Cliente</th>
                    <th>Data e Hora</th>
                    <th>Número de Pessoas</th>
                    <!-- Adicione mais colunas conforme necessário -->
                </tr>
            </thead>
            <tbody id="tabelaReservas">
            <?php
                // Conectar ao banco de dados
                include('connection.php');

                // Obter a data atual no formato 'DD-MM-YYYY'
                $dataAtual = date('Y-m-d');

                // Recuperar dados da tabela de reservas para o dia atual
                $sql = "SELECT * FROM reservas WHERE Dia = '$dataAtual'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Utilize a função date para formatar a data
                        $dataFormatada = date('d-m-Y', strtotime($row["Dia"]));
                        
                        echo "<tr>
                                <td>" . $row["nome"] . "</td>
                                <td>" . $dataFormatada . "  " . $row["Hora"] . "</td>
                                <td>" . $row["Numero_Pessoas"] . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma reserva encontrada para o dia atual</td></tr>";
                }

                $conn->close();
            ?>
            </tbody>
        </table>

    </div>
</body>
</html>