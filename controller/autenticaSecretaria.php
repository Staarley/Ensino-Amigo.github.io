<?php
require_once("../model/conexao.php");
session_start();
$email = $_POST['email'];
$senha = $_POST['senha'];

$conn = new Conexao();
$codSecretaria = $conn->autenticaSecretaria($email, $senha);


if ($codSecretaria) {
    $_SESSION['email'] = $email;
    $_SESSION['codSecretaria'] = $codSecretaria; 
    echo "<script>window.location.href='../view/secretaria/inicioSec.php';</script>";
} else {
    die("Erro: Usuário ou senha inválidos.");
}



?>
