<?php
include "proteger.php";
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idprod = $_POST['Id_produto'];
    $idmesa = $_POST['idmesa'];
} else {
    header("location:mesas.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ingredientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="mystyle.css">
    <style>
        body {
            background-image: url('imagens/login.png');
            background-size: cover;
            background-attachment: fixed;
        }
        .container {
            background: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 0 auto;
        }
        .ing-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .ingredientes-container {
            display: flex;
            flex-direction: column;
        }
        .ingredient {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .ingredient input[type="checkbox"] {
            margin-right: 10px;
        }
        .product-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            margin-right: 40px;
        }
    </style>
</head>
<body>
    <h2>Ingredientes</h2>
    <br>
    <div class="container">
        <form action="pedidos.php?id=<?php echo $idmesa ?>" method="POST">
            <div class="ing-container">
                <?php
                $sql = "SELECT * FROM `produtos` WHERE `ID_P` =" . $idprod;
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);

                    // Exibir imagem do produto
                    echo "<img src=\"imagens/" . $row["Imagem"] . "\" alt=\"" . $row["Produto"] . "\" class=\"product-image\">";

                    // Verificar o tipo de produto e exibir o layout apropriado
                    if ($row["Tipo"] == "entrada" || $row["Tipo"] == "sobremesa") {
                        echo "<textarea name =\"obs\" class=\"textarea\">" . $row["Ingredientes"] . "</textarea><br>";
                    } elseif ($row["Tipo"] == "hamb" || $row["Tipo"] == "snack") {
                        $ingredientes = explode("\n", $row["Ingredientes"]);

                        echo "<div class=\"ingredientes-container\">";
                        foreach ($ingredientes as $ingrediente) {
                            $ingrediente = trim($ingrediente);
                            $checked = (strpos($row["Ingredientes"], $ingrediente) !== false) ? "checked" : "";

                            echo "<div class=\"ingredient\">";
                            echo "<input type=\"checkbox\" name=\"ingredientes[]\" value=\"$ingrediente\" $checked style=\"transform: scale(1.5);\">";
                            echo "<label style=\"color: black;\">$ingrediente</label>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                }
                ?>

                <?php
                if ($row["Tipo"] == "hamb" || $row["Tipo"] == "snack") {
                    echo '<div class="col-12" style="text-align: center;">';

                    echo '<div class="col-6" style="text-align: left;">';
                    echo '<h2 style="color:black; text-align:left"> Pães </h2>';
                    $sqlPao = "SELECT * FROM pao";
                    $resultPao = mysqli_query($conn, $sqlPao);
                    if (mysqli_num_rows($resultPao) > 0) {
                        while ($rowPao = mysqli_fetch_assoc($resultPao)) {
                            echo "<input class=\"radio\" type=\"radio\" name=\"pao\" value=\"" . $rowPao['tipo'] . "\" style=\"transform: scale(1.5);\" required>
                            <label style=\"color:black\"> " . $rowPao['tipo'] . " </label> <br>";
                        }
                    }
                    echo '</div>';

                    echo '<div class="col-6" style="text-align: left;">';
                    echo '<h2 style="color:black;\"> Acompanhamentos </h2>';
                    $sql = "SELECT * FROM acompanhamentos";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<input class=\"check\" type=\"checkbox\" name=\"acompanhamentos[]\" value=\"" . $row['Nome'] . "\" style=\"transform: scale(1.5);\">
                                    <label style=\"color:black\"> " . $row['Nome'] . " </label> <br>";
                        }
                    }
                    echo '</div>';

                    echo '</div>';
                }
                ?>
                <div class="col-12 centrar">
                    <input type="hidden" name="idmesa" value="<?php echo $idmesa; ?>">
                    <input type="hidden" name="Id_produto" value="<?php echo $idprod; ?>">
                    <a class="btnhref" href='pedidos.php?id=<?php echo $idmesa; ?>'>Voltar</a>
                    <input type="hidden" name="idmesa" value="<?php echo $idmesa; ?>">
                    <input type="hidden" name="Id_produto" value="<?php echo $idprod; ?>">
                    <input type="submit" class="btn" name="hamb" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</body>
</html> 