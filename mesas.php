<?php
    include "proteger.php";
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['mesa'])) {
            $mesa = $_GET['mesa'];
            $sql = "DELETE FROM pedidos WHERE ID_Mesa = $mesa AND Estado = 'A' ";
            $result = mysqli_query($conn, $sql);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Amostra de Mesas no Restaurante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        max-height: auto;
    }

    h2 {
        font-size: 26px;
        margin-bottom: 20px;
        color: Black;
    }

    /* Modal Styling */
    .modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -70%);
        background-color: rgba(100, 100, 100, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }

    .size{
        font-size:22px;
        color:red;
    }
    </style>
    <script>
        function ocupacao(idmesa){
            window.open("pedidos.php?id="+idmesa, "_self");
        }

        function toggleMenu() {
            var menu = document.getElementById('menu');
            menu.style.display = 'block';
            document.getElementById('btmenu').style.display ='none';
            document.getElementById('btfechar').style.display ='block';
        }

        function closeMenu() {
            var menu = document.getElementById('menu');
            menu.style.display = 'none';
            document.getElementById('btmenu').style.display ='block';
            document.getElementById('btfechar').style.display ='none';
        }

        function showReservas() {
        var modal = document.getElementById('modalReservas');
        modal.style.display = 'block';
    }

    // Função para fechar o modal de reservas
    function closeReservas() {
        var modal = document.getElementById('modalReservas');
        modal.style.display = 'none';
    }

    // Função para fechar o modal quando clicar fora dele
    window.onclick = function(event) {
        var modal = document.getElementById('modalReservas');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Função para fechar o modal ao pressionar a tecla Esc
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.key === "Escape") {
            closeReservas();
        }
    }
    </script>
</head>
<body>

    <div class="container">
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="size" onclick="showReservas()">Reservas<span>&#9660;</span></button>
        </div>
        
        <button onclick="toggleMenu()" id="btmenu"><i class="fa fa-navicon" style="font-size:36px"></i></button>
        <div class="menu" id="menu">
            <button onclick="closeMenu()"  id="btfechar"><i class="fa fa-times-rectangle" style="font-size:36px;color:red"></i></button>
            <a href="produtos.php">Adicionar Produtos</a>
            <a href="reservas.php">Reservas</a>
            <a href="logout.php?ide=<?php echo $_SESSION['util']; ?>">Sair</a>
        </div>
        <h2>Escolha a mesa</h2>
        <div class="mesas-container">
            <?php
                $sql = "SELECT * FROM mesas";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<button class="mesa" id="' . $row["ID_M"]. '" onclick="ocupacao(' . $row["ID_M"]. ')">' . $row["Descricao"].'</button>';
                    }
                } 
            ?>
        </div>
    </div>

    <div id="modalReservas" class="modal">
    <div id="reservasContent">
        <?php include 'modal_reservas.php'; ?>
    </div>
    <br>
    <button class="modal-btn" onclick="closeReservas()">Fechar</button>
</div>
</body>
</html>