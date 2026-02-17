<?php
include "proteger.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Acompanhamento ou Produto</title>
    <style>

        body{
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }
        textarea{
          width: 579px;
          height: 103px;
        }
        input, textarea, select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"],
        input[type="password"],
        textarea,
        select {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 18px;
        }

        input[type="submit"] {
            background-color: #e1a122;
            color: white;
            cursor: pointer;
            padding: 15px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #be830c;
        }

        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                border-radius: 0;
                padding: 10px;
            }

            input,
            textarea,
            select {
                width: calc(100% - 16px);
                padding: 10px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
  <div class="container">
    <h1>Adicionar Acompanhamento ou Produto</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nomeprod">Nome:</label>
            <input type="text" id="nomeprod" name="nomeprod">
            <br><br>
            <label for="ingredientes">Observações:</label>
            <textarea id="ingredientes" name="ingredientes"></textarea>
            <br><br>
            <label for="image">Foto do Produto:</label>
            <input type="file" id="image" name="image">
            <br><br>
            <select name="tipo" id="tipo">
                <option value="entrada">Entrada</option>
                <option value="hamb">Hamburguer</option>
                <option value="snack">Snack</option>
                <option value="sobremesa">Sobremesa</option>
                <option value="Acompanhamento">Acompanhamento</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Adicionar">
        
    </form>
    <form action="mesas.php">
        <input type="submit" value="Voltar">
    </form>
    </div>
    <?php
        include "connection.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nomeprod"];
            $descricao = $_POST["ingredientes"];
            $tipo = $_POST["tipo"];

            if ($tipo == 'hamb' || $tipo == 'entrada' || $tipo == 'snack' || $tipo == 'sobremesa') {
                $uploadDir = "imagens/";
                $targetFile = '';

                if (isset($_FILES['image'])) {
                    $imageName = basename($_FILES['image']['name']);
                    $targetFile = $uploadDir . $imageName;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        // Defina o ID de acordo com a lógica do seu banco de dados (por exemplo, auto-incremento no MySQL).
                        $id = "";

                        $sql = "INSERT INTO produtos (ID_P, Produto, Ingredientes, Tipo, Imagem) VALUES ('$id', '$nome', '$descricao', '$tipo', '$imageName')";
                        
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            echo "Produto adicionado com sucesso!";
                        } else {
                            echo "Erro ao adicionar produto: " . mysqli_error($conn);
                        }
                    }
                }
            } else if ($tipo == 'Acompanhamento') {
                // Defina o ID de acordo com a lógica do seu banco de dados.
                $id = "";

                $sql = "INSERT INTO acompanhamentos (ID_A, Nome) VALUES ('$id', '$nome')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "Acompanhamento adicionado com sucesso!";
                } else {
                    echo "Erro ao adicionar acompanhamento: " . mysqli_error($conn);
                }
            }
        }
    ?>
</body>
</html>