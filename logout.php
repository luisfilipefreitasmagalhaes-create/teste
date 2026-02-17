<?php
session_start();

// Verifica se o ID do empregado está presente na sessão
if(isset($_SESSION['util']) && isset($_SESSION['ID_E']) && $_SESSION['util'] == $_SESSION['ID_E']) {
    // Limpa todas as variáveis de sessão
    $_SESSION = array();

    // Destroi a sessão
    session_destroy();

    // Redireciona para a página de login (ou qualquer outra página desejada após o logout)
    header("Location: index.php");
    exit;
} else {
    // Se o ID do empregado não estiver presente na sessão ou não corresponder ao ID passado via GET,
    // redireciona para a página de login
    header("Location: index.php");
    exit;
}
?>
