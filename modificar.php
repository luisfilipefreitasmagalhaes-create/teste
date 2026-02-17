<?php
    include "proteger.php";
    include "connection.php";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mesa = $_GET["mesa"];  
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Pedido</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        .back-arrow {
            position: absolute;
            top: 40px;
            left: 20px;
            text-decoration: none;
            font-size: 24px;
            z-index: 1000; /* Adjust the value as needed */
        }
    </style>
</head>
<body>
    <a href="pedidos.php?id=<?php echo $mesa; ?>" class="back-arrow"><i class="fas fa-arrow-left"></i></a>
    <h2 class = "h2">Modificar Pedido</h2>
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
        $sql = "SELECT * 
        FROM pedidos, produtos
        WHERE (pedidos.Estado ='A') 
        AND pedidos.ID_Mesa = $mesa
        AND pedidos.ID_Produto = produtos.ID_P";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>".$mesa."</td>
            <td>".$row["Produto"]."</td>
            <td>".$row["Obs"]."</td>"
            ?>
            <td > <a href="modificarprod.php?mesa=<?php echo $row['ID_Mesa']; ?>&produto=<?php echo $row['ID_Produto']; ?>" class="button">Modificar</a>
            <br>
            <a href="eliminarprod.php?mesa=<?php echo $row['ID_Mesa']; ?>&produto=<?php echo $row['ID_Produto']; ?>" class="button">Novo</a>
            <?php               
            echo"</td>
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