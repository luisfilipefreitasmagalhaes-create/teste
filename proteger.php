<?php
session_start();
if (!isset($_SESSION['util'])) {
    header("Location: index.php");
    exit;
}
?>