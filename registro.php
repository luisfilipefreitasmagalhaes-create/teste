<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
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
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
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
        <h2>Registro</h2>
        <form method="POST" action="processar_registro.php">
            <div class="form-group">
                <label for="username">Nome do Funcionário:</label>
                <input type="text" id="func" name="func" placeholder="Digite o seu nome" required>
                <br>
                <br>
                <label for="sobrenome">SobreNome do Funcionário:</label>
                <input type="text" id="sobfunc" name="sobfunc" placeholder="Digite o seu sobrenome" required>
                <br>
                <br>
                <label for="cargo">Cargo</label>
                <select class=select id="cargo" name="cargo">
                <?php
                include("connection.php");
                // Consulta SQL para obter os funcionários existentes
                $sql = "SELECT Cargo FROM Cargos";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['Cargo'] . '">' . $row['Cargo'] . '</option>';
                    }
                    mysqli_free_result($result);
                }

                mysqli_close($conn);
                ?>
            </select>
            </div>
            <div class="form-group password-container">
                <label for="password">Password:</label>
                <input type="password" id="psw" name="psw" placeholder="Digite sua senha" required>
                <span class="password-toggle" onclick="togglePasswordVisibility()">
                    <i id="eyeIconOpen" class="fa">&#xf06e;</i>
                    <i id="eyeIconClosed" class="fa closed-eye">&#xf070;</i>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" value="Registrar">
            </div>
        </form>
        <a href='index.php'>Voltar</a>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("psw");
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