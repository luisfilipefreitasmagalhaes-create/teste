<?php 
    include "proteger.php";
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabela para Cozinha</title>
    <link rel="stylesheet" href="mystyle.css">
    <style>
        .h2{
            text-align: center;
            color: red;
            font-size: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
    </style>
</head>
<body>
    <h2 class = "h2">Pedidos na Cozinha</h2>
    <table>
        <thead>
            <tr>
                <th>Mesa</th>
                <th>Pedido</th>
                <th>Ingredientes</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        $sql = "SELECT * FROM pedidos, produtos, mesas WHERE pedidos.Estado ='C' AND pedidos.ID_Mesa=mesas.ID_M AND pedidos.ID_Produto=produtos.ID_P ORDER BY ID_Mesa";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>".$row["Descricao"]."</td>
            <td>".$row["Produto"]."</td>
            <td>".$row["Obs"]."</td>
            <td > <a href=\"atualizarcoz.php?id=".$row["ID"]."\" class =\"button\">Pronto</a>               
            </td>
        </tr>";


          
        } 
    }
        ?>
        </tbody>
    </table>
<?php
mysqli_close($conn);
?>
</body>
</html>
<script>
    window.setTimeout( function() {
    window.location.reload();
    }, 3000);
</script>