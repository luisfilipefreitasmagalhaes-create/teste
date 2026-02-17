<?php
include "proteger.php";
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idprod = $_POST['Id_produto'];
    $idmesa = $_POST['idmesa'];
    $idfunc = $_SESSION['ID_E'];
    $obs = "";

    // Recuperar o produto e ingredientes da tabela "produtos"
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

        // Atualizar o pedido na tabela "pedidos"
        $sql_update = "UPDATE pedidos SET Obs = '$obs' WHERE ID_Mesa = $idmesa AND Estado = 'A'";
        $result_update = mysqli_query($conn, $sql_update);

        if ($result_update && mysqli_affected_rows($conn) > 0) {
            // Redirecionar para a página de mesas após a atualização bem-sucedida
            header("Location: pedidos.php?id=$idmesa");
            exit();
        } else {
            // Se houver um erro ao atualizar o registro
            echo "Error updating records: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>