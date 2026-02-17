<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["func"];
    $sobrenome = $_POST["sobfunc"];
    $carg = $_POST["cargo"];
    $senha = $_POST["psw"];

    // Evite SQL injection usando declarações preparadas
    $stmt = $conn->prepare("INSERT INTO empregados (Nome, SobreNome, Pass, Cargo) VALUES ('$nome', '$sobrenome', '$senha', '$carg')");

    if ($stmt->execute()) {
        // Registro bem-sucedido
        $message = "Registro bem-sucedido!";
    } else {
        $message = "Erro no registro: " . $stmt->error;
    }

    $stmt->close();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="mystyle.css">
    <style>
    /* Estilos CSS permanecem inalterados. */
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <?php
        if (isset($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
        <a href="index.php">Voltar para a página de login</a>
    </div>
</body>
</html>