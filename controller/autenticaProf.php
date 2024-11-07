<?php
require_once("../model/conexao.php");
session_start();
$email = $_POST['email'];
$senha = $_POST['senha'];

$conn = new Conexao();
$codProfessor = $conn->autenticaProf($email, $senha);

var_dump($_SESSION); // Adicione esta linha

if ($codProfessor) {
    $_SESSION['email'] = $email;
    $_SESSION['codProfessor'] = $codProfessor; 
    echo "<script>window.location.href='../view/prof/inicioProf.php';</script>";
} else {
    die("Erro: Usuário ou senha inválidos.");
}



?>
