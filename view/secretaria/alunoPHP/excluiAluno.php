<?php
require_once '../../../model/conexao.php';
session_start();

if (isset($_GET['ra'])) {  // Alterado para 'ra'
    $ra = $_GET['ra'];  // Alterado para 'ra'
    $conn = new Conexao();

    // Prepara e executa a query para excluir o aluno
    $query = "DELETE FROM aluno WHERE ra = :ra";  // Alterado para 'ra'
    $stmt = $conn->getConnection()->prepare($query);
    $stmt->bindParam(':ra', $ra);  // Alterado para 'ra'

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Aluno excluído com sucesso!';
    } else {
        $_SESSION['message'] = 'Erro ao excluir o aluno.';
    }
}

// Redireciona de volta para a página de consulta de alunos
header("Location: consulAluno.php");
exit;
?>
