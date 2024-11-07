<?php
require_once '../../../model/conexao.php';
session_start();

if (isset($_GET['codQuestionario'])) {  // Alterado para 'ra'
    $ra = $_GET['codQuestionario'];  // Alterado para 'ra'
    $conn = new Conexao();

    // Prepara e executa a query para excluir o aluno
    $query = "DELETE FROM questionario WHERE codQuestionario = :cod";  // Alterado para 'ra'
    $stmt = $conn->getConnection()->prepare($query);
    $stmt->bindParam(':cod', $cod);  // Alterado para 'ra'

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Questionario excluído com sucesso!';
    } else {
        $_SESSION['message'] = 'Erro ao excluir o questionario.';
    }
}

// Redireciona de volta para a página de consulta de quest
header("Location: consulQuest.php");
exit;
?>