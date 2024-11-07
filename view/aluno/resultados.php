<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
</head>
<body>

<?php
session_start();
require_once '../../model/conexao.php';

$conexao = new Conexao();
$codProfessor = $_SESSION['codProfessor'];

// Obtém todas as turmas do professor logado
$turmas = $conexao->selectTurma($codProfessor);

if (!empty($turmas)) {
    echo "<h1>Selecione uma Turma</h1>";
    echo "<ul>";
    foreach ($turmas as $turma) {
        echo "<li>{$turma['nomeTurma']} 
            <form action='questionariosRespondidos.php' method='POST'>
                <input type='hidden' name='codTurma' value='{$turma['codTurma']}'>
                <button type='submit'>Selecionar</button>
            </form>
            </li>";
    }
    echo "</ul>";
} else {
    echo "<p>Você não tem turmas cadastradas.</p>";
}
?>

</body>
</html>
