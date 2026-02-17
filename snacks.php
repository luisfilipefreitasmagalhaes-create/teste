<?php
    include "proteger.php";
    include "connection.php";
    $mesa = $_GET["id"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pedidos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="mystyle.css">
    <style>
      body {
            font-family: Arial, sans-serif;
            background-size: cover;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Define a imagem de fundo */
            background-image: url('imagens/login.png');
            /* Ajusta o tamanho da imagem */
            background-size: cover;
            /* Garante que a imagem cubra toda a tela */
            background-attachment: fixed;
        }
        .container {
            background: rgba(255, 255, 255, 0.8); /* Cor branca com 50% de transparência */
            padding: 40px; /* Aumentei o padding para expandir o conteúdo */
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 750px; /* Ajuste a largura máxima conforme necessário */
            margin: 0 auto; /* Centraliza o container na página */
            max-height: auto;
            position: relative; /* Adiciona posição relativa para que a seta fique dentro do container */
        }
        .back-arrow {
            position: absolute;
            top: 40px;
            left: 20px;
            text-decoration: none;
            font-size: 24px;
        }
        .product-container {
            text-align: center;
            margin: 20px; /* Aumentei a margem para maior espaçamento */
        }
        .product-container img {
            width: 150px; /* Aumentei a largura */
            height: 150px; /* Aumentei a altura */
            object-fit: cover;
            border-radius: 10px; /* Adicionei bordas arredondadas */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Adicionei sombra para destacar */
        }
        .product-columns {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; /* Alinha itens com espaço entre eles */
        }
        .product-column {
            flex: 0 1 calc(33.33% - 40px); /* Ajusta a largura para três colunas com espaço entre elas */
            margin-bottom: 40px; /* Adiciona espaçamento inferior */
            display: flex;
            justify-content: center;
        }
        .product-container span{
            color: black;
            display: block; /* Garante que o texto fique abaixo da imagem */
            margin-top: 10px; /* Adiciona espaçamento acima do texto */
        }
        h2{
            color: black;
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
            <div class="mesas-container">
            <a href='pedidos.php?id=<?php echo htmlspecialchars($mesa); ?>&op=del' class="back-arrow"><i class="fas fa-arrow-left"></i></a>
                <h2> Snacks</h2>
                <form class="" method="post" action="ingredientes.php" id="product-form-produto">
            
                    <input type="hidden" id="idmesa" name="idmesa">
                    <input type="hidden" id="Id_produto" name="Id_produto">
                   
                        <?php
                        // Simulação de mesas do restaurante
                        $sql = "SELECT * FROM produtos WHERE tipo ='snack'";
                        $result = mysqli_query($conn, $sql);

                        $itemCount = 0; // Inicializa a contagem de itens exibidos
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            echo '<div class="product-columns">'; // Abre uma div para as colunas
                            while ($row = mysqli_fetch_assoc($result)) {    
                                if ($itemCount % 3 === 0) {
                                    // Abre uma nova coluna a cada 3 produtos
                                    echo '<div class="product-column"> <br><br>';
                                }
                                echo "
                                <div class=\"product-container\">
                                <button value=\"hamb\" type=\"button\" id=\"" . $row["ID_P"] . "\" onclick=\"escolher_produto('hamb', " . $row["ID_P"] . ", " . $mesa . ")\">
                                        <img src=\"imagens/" . $row["Imagem"] . "\" alt=\"" . $row["Produto"] . "\">
                                        <br>
                                        <span>" . $row["Produto"] . "</span>
                                    </button>
                                </div>";

                                if ($itemCount % 3 === 2) {
                                    // Fecha a coluna após exibir 3 produtos
                                    echo '</div>';
                                }
                                $itemCount++;
                            }

                            // Certifique-se de fechar a última coluna e a div das colunas, se necessário
                            if ($itemCount % 3 !== 0) {
                                echo '</div>'; // Fecha a última coluna
                            }
                            echo '</div>'; // Fecha a div das colunas
                        } else {
                            echo "Nenhum produto disponível.";
                        }
                        ?>
                  
                </form>
            </div>
        <br>
    </div>
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>
