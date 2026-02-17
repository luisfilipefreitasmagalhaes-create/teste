<?php
// Conexão com o banco de dados
include("connection.php");

$class="novaclass";
// Consulta SQL para obter os dados dos funcionários e seus pedidos apenas se estiverem no estado 'F'
$sql = "SELECT e.Nome, e.SobreNome, e.Cargo, p.ID_Mesa, pr.Produto 
        FROM empregados e, pedidos p, produtos pr
        WHERE p.Estado = 'F' AND p.ID_Produto = pr.ID_P AND e.ID_E = p.ID_F ORDER BY e.SobreNome";

$result = mysqli_query($conn, $sql);

// Verifica se a consulta retornou resultados
if ($result && mysqli_num_rows($result) > 0) {
    // Exibir a tabela de funcionários e pedidos
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestão de Funcionários e Pedidos</title>
        <style>
            .h2{
                text-align: center;
                color: red;
                font-size: 50px;
            }

            .tabletb1 {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
            }

            th, td {
                padding: 15px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                font-size: 20px;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
                font-size: 30px;
            }

            tr:hover {
                background-color: #f5f5f5;
            }

            .button {
                cursor: pointer;
                background-color: green;
                color: white;
                border: none;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 20px;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .button:hover {
                background-color: darkgreen;
            }
            
            .back-arrow {
                position: absolute;
                top: 40px;
                left: 20px;
                text-decoration: none;
                font-size: 24px;
                z-index: 1000; 
            }

            .search-bar {
                margin-bottom: 20px; 
            }

            .search-bar input[type="text"] {
                width: 100%; 
                padding: 10px; 
                border: none; 
                border-bottom: 5px solid #007bff; 
                background-color: transparent; 
                font-size: 16px; 
                color: #333; 
                transition: border-bottom-color 0.3s; 
            }

            .search-bar input[type="text"]:focus {
                outline: none;
                border-bottom-color: #0056b3; 
            }
        </style>
    </head>
    <body>
<a href='index.php' class="back-arrow"><i class="fas fa-arrow-left"></i></a>
<h2 class="h2">Gestão de Funcionários e Pedidos</h2>

<input type="text" id="searchInput" class="search-bar" onkeyup="searchTable()" placeholder="Pesquisar por nome..">

<table class="tabletb1">
    <thead>
        <tr>
            <th>Nome</th>
            <th>SobreNome</th>
            <th>Cargo</th>
            <th>Pedidos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop através dos resultados da consulta
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['Nome'] . '</td>';
            echo '<td>' . $row['SobreNome'] . '</td>';
            echo '<td>' . $row['Cargo'] . '</td>';
            echo '<td>';
            if ($row['ID_Mesa'] && $row['Produto']) {
                echo '<ul>';
                echo '<li>Mesa ' . $row['ID_Mesa'] . ' - ' . $row['Produto'] . '</li>';
                echo '</ul>';
            } else {
                echo 'Nenhum pedido feito';
            }
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<script>
function searchTable() {
    // Declare variáveis
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.querySelector(".tabletb1");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // Filtrar pela primeira coluna (Nome)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>

</body>
</html>
    <?php
    // Liberar o resultado
    mysqli_free_result($result);
} 

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>