<?php
require_once '../../model/conexao.php';
session_start();

if (isset($_GET['codQuestionario'])) {
    $codQuestionario = $_GET['codQuestionario'];
    $conn = new Conexao();
    echo "codQuestionario recebido: " . htmlspecialchars($codQuestionario);


    try {
        $conn->getConnection()->beginTransaction();

        // Exclui as perguntas associadas ao questionário
        $queryPerguntas = "DELETE FROM perguntas WHERE codQuestionario = :codQuestionario";
        $stmtPerguntas = $conn->getConnection()->prepare($queryPerguntas);
        $stmtPerguntas->bindParam(':codQuestionario', $codQuestionario);
        $stmtPerguntas->execute();

        // Exclui o questionário
        $queryQuestionario = "DELETE FROM questionario WHERE codQuestionario = :codQuestionario";
        $stmtQuestionario = $conn->getConnection()->prepare($queryQuestionario);
        $stmtQuestionario->bindParam(':codQuestionario', $codQuestionario);
        $stmtQuestionario->execute();

        $conn->getConnection()->commit();
        $_SESSION['message'] = 'Questionário e suas perguntas foram excluídos com sucesso!';
    } catch (PDOException $e) {
        $conn->getConnection()->rollBack();
        $_SESSION['message'] = 'Erro ao excluir o questionário: ' . $e->getMessage();
    }
}

header("Location: iniciarQuest.php");
exit;
?>
