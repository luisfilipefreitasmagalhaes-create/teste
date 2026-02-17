<?php
include "proteger.php";
include "connection.php";

$mesa = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idprod = $_POST['Id_produto'];
    $idmesa = $_POST['idmesa'];
    $idfunc = $_SESSION['ID_E'];

    // Recupere o produto e ingredientes da tabela "produtos"
    $sql = "SELECT Produto, Ingredientes FROM produtos WHERE ID_P = $idprod";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $produto = $row["Produto"];
        $ingredientes = isset($_POST['ingredientes']) ? $_POST['ingredientes'] : [];
        $acompanhamentos = isset($_POST['acompanhamentos']) ? $_POST['acompanhamentos'] : [];
        $paoEscolhido = isset($_POST['pao']) ? $_POST['pao'] : '';

        // Combine os ingredientes com um espaço entre cada um
        //$obs = nl2br($row["Ingredientes"]); // Mantém as quebras de linha existentes
    
        // Adiciona o tipo de pão à observação
        if (!empty($paoEscolhido)) {
            $obs .= "<br><strong>Tipo de Pão:</strong> " . $paoEscolhido;
        }

        if (!empty($ingredientes)) {
            $obs .= "<br><strong>Ingredientes:</strong><br>";
            foreach ($ingredientes as $key => $ingrediente) {
                $obs .= $ingrediente . "<br>";
            }
        }
        
        // Adiciona os acompanhamentos selecionados
        if (!empty($acompanhamentos)) {
            $obs .= "<br><strong>Acompanhamentos:</strong><br>";
            foreach ($acompanhamentos as $key => $acompanhamento) {
                $obs .= $acompanhamento . "<br>";
            }
        }

            $sqlInserir = "INSERT INTO pedidos (id_produto, ID_F, id_mesa, Obs, Estado) VALUES ('$idprod','$idfunc', '$idmesa', '$obs', 'A')";
            if (mysqli_query($conn, $sqlInserir)) {
                // Pedido inserido com sucesso
                // Redirecionar para evitar o reenvio ao atualizar a página
                header("Location: pedidos.php?id=$idmesa");
                exit();
            } else {
                // Erro ao inserir o pedido
                echo "Erro ao inserir o pedido: " . mysqli_error($conn);
            }
        
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Pedidos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="mystyle.css">
    <style>

/* Estilos gerais */
body {
    font-family: Arial, sans-serif;
    background-size: cover;
    margin: 0;
    padding: 0;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url('imagens/entradas.png');
    background-size: cover;
    background-attachment: fixed;
}

.container {
    background: rgba(255, 255, 255, 0.8);
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 0 auto;
    max-height: auto;
}

h2 {
    color: black;
}

/* Estilos para os botões das categorias */
.categories {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.category-button {
    width: 150px;
    height: 150px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
    color: black;
    cursor: pointer;
}

.category-button:hover {
    background-color: #E63946;
    color: #fff;
}

@media (max-width: 768px) {
    .categories {
        justify-content: flex-start;
    }
    .category-button {
        flex: 0 0 calc(50% - 20px);
    }
}
    </style>
    <script>
        function escolher_produto(type, Idproduto, idmesa) {
            const mesaInput = document.getElementById("idmesa");
            const produtoInput = document.getElementById("Id_produto");

            mesaInput.value = idmesa;
            produtoInput.value = Idproduto;

            // Determine which form to submit based on the "type"
                document.getElementById("product-form-produto").submit();
                mesaInput.value;
                produtoInput.value;
        }
    </script>
</head>
<body>
    <h2 style="color:white;"> <?php echo "MESA " . $mesa; ?></h2>
    <div class="container">
    <h2> Categorias</h2>
        <div class="mesas-container">
            <div class="categories">
                <a href="entradas.php?id=<?php echo $mesa; ?>" type="hidden" name="idmesa" value="<?php echo $mesa; ?>" class="category-button">Entradas</a>
                <a href="hamburgueres.php?id=<?php echo $mesa; ?>" class="category-button">Hamburguer</a>
                <a href="snacks.php?id=<?php echo $mesa; ?>" class="category-button">Snacks</a>
                <a href="sobremesas.php?id=<?php echo $mesa; ?>" class="category-button">Sobremesas</a>
            </div>
        </div>
        <div class="mesas-container">
            <form action="upload_produto.php" method="POST">
            <input type="hidden" name="ingredientes_selecionados" id="ingredientes_selecionados">
                <div class="col-12 centrar">
                    <a class="btnhref" href='mesas.php?mesa=<?php echo $mesa; ?>&op=del'>Voltar</a>
                    <a class="btnhref" href='modificar.php?mesa=<?php echo $mesa; ?>'>Modificar</a>
                    <input type="hidden" name="Id_produto" value="<?php echo $idprod; ?>">
                    <input type="hidden" name="idmesa" value="<?php echo $mesa; ?>">
                    <input type="submit" class="btn" value="Finalizar">
                </div>
            </form>
        </div>
    </div>

</body>
</html>
