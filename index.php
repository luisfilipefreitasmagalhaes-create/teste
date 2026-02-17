<?php
session_start();

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['util'];
    $password = $_POST['pass'];

    // Consulta SQL para verificar os dados de login
    $sql = "SELECT ID_E, Nome, Pass, Cargo FROM empregados WHERE Nome = '$username' AND Pass = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Dados de login corretos
        $row = mysqli_fetch_assoc($result);
        $_SESSION['util'] = $username;
        $_SESSION['ID_E'] = $row["ID_E"];
        
        if ($_POST['sitio'] == "mesas" && $row['Cargo'] != "Cozinheiro") {
            header("Location: mesas.php");
            exit;
        } elseif ($_POST['sitio'] == "cozinha" && $row['Cargo'] != "Garçom") {
            header("Location: cozinha.php");
            exit;
        } elseif ($_POST['sitio'] == "gerenciar" && $row['Cargo'] == "Chefe") {
            header("Location: gerenciar.php");
            exit;
        } else {
            header("Location: index.php?error=1");
            exit;
        }
    } else {
        $error_message = "Dados de login incorretos. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login do Restaurante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mystyle.css">
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Apply a background image to the body */
        body {
            font-family: Arial, sans-serif;
            background-image: url("imagens/login.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 8px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle box shadow */
        }

        h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: black; /* Dark text color */
        }

        .form-group {
            margin: 15px 0;
        }

        label {
            display: block;
            font-weight: bold;
            color: #000; /* Black text color */
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;    
        }

        .select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input[type="submit"] {
            color: white;
            padding: 20;
            border: none;
            width:100%; 
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue color on hover */
        }
 
        .error-message {
            color: #FF0000; /* Red error message */
            font-size: 16px;
            margin-top: 10px;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            font-size: 22px;
            cursor: pointer;
            color: #333; /* Dark color for the eye icon */
        }

        .closed-eye {
            display: none;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="index.php">
            <label for="util">Funcionário</label>
            <select class=select id="util" name="util">
                <?php
                include("connection.php");
                // Consulta SQL para obter os funcionários existentes
                $sql = "SELECT Nome FROM empregados";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['Nome'] . '">' . $row['Nome'] . '</option>';
                    }
                    mysqli_free_result($result);
                }

                mysqli_close($conn);
                ?>
            </select>
            <div class="form-group password-container">
                <label for="password">Password:</label>
                <input type="password" id="pass" name="pass" placeholder="Digite sua senha" required>
                <span class="password-toggle" onclick="togglePasswordVisibility()">
                    <i id="eyeIconOpen" class="fa">&#xf06e;</i>
                    <i id="eyeIconClosed" class="fa closed-eye">&#xf070;</i>
                </span>
            </div>     
            <select name="sitio" id="sitio">
                <option value="mesas">Mesas</option>
                <option value="cozinha">Cozinha</option>
                <option value="gerenciar">Gerenciar Restaurante</option>
            </select>
            <br>
            <div class="form-group">
                <input type="submit" value="Entrar">
            </div>
            <?php
            if (isset($_GET['error'])) {
                echo '<div class="error-message">Não tem permissão para entrar aqui.</div>';
            }
            ?>
        </form>

        <div class="register-link">
            <p style="text-align:center;">Novo Funcionário? <a href="registro.php">Registra-se</a></p>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("pass");
            var eyeIconOpen = document.getElementById("eyeIconOpen");
            var eyeIconClosed = document.getElementById("eyeIconClosed");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIconOpen.style.display = "none";
                eyeIconClosed.style.display = "inline";
            } else {
                passwordInput.type = "password";
                eyeIconOpen.style.display = "inline";
                eyeIconClosed.style.display = "none";
            }
        }
    </script>
</body>
</html>
