<?php
require_once("conexao.php");
session_start();

$ra = $_POST['ra'];
$data = $_POST['data'];
$conn = new Conexao();

$resultado = $conn->autenticaAluno($ra, $data);

if ($resultado) {
    $_SESSION['codAluno'] = $resultado['codAluno'];
    $_SESSION['codTurma'] = $resultado['codTurma']; 

    header("Location: ../view/aluno/telaAluno.php");
} else {
    die("Erro: Usuário ou senha inválidos.");
}
?>
