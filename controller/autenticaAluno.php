<?php
require_once("../model/conexao.php");
session_start();
$ra = $_POST['RA'];
$data = $_POST['data'];

$conn = new Conexao();
$codAluno = $conn->autentica($ra, $data);

var_dump($_SESSION); // Adicione esta linha

if ($codProfessor) {
    $_SESSION['ra'] = $ra;
    $_SESSION['data'] = $data; 
    echo "<script>window.location.href='../view/inicio.php';</script>";
} else {
    die("Erro: Usuário ou senha inválidos.");
}



?>
