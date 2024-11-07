<?php
session_start();
require_once("../model/conexao.php");

$conn = new Conexao();
$pdo = $conn->getConnection();

// Verifica se o código da turma foi passado pela URL
if (isset($_GET['codTurma'])) {
    $codTurma = $_GET['codTurma']; // Recebe o código da turma a ser excluída

    try {
        // Inicia uma transação para garantir que a exclusão de dados seja feita de forma segura
        $pdo->beginTransaction();

        // Exclui as respostas associadas aos alunos da turma
        $deleteRespostasQuery = "DELETE FROM respostas WHERE codAluno IN (SELECT codAluno FROM aluno WHERE codTurma = :codTurma)";
        $stmtDeleteRespostas = $pdo->prepare($deleteRespostasQuery);
        $stmtDeleteRespostas->bindParam(':codTurma', $codTurma);
        $stmtDeleteRespostas->execute();

        // Exclui a turma
        $deleteTurmaQuery = "DELETE FROM turma WHERE codTurma = :codTurma";
        $stmtDeleteTurma = $pdo->prepare($deleteTurmaQuery);
        $stmtDeleteTurma->bindParam(':codTurma', $codTurma);
        $stmtDeleteTurma->execute();

        // Commit da transação
        $pdo->commit();

        $_SESSION['success_message'] = 'Turma excluída com sucesso!';
    } catch (PDOException $e) {
        // Em caso de erro, faz o rollback da transação
        $pdo->rollBack();
        $_SESSION['error_message'] = 'Erro ao excluir turma: ' . $e->getMessage();
    }
} else {
    $_SESSION['error_message'] = 'Código da turma não fornecido.';
}

header("Location: ../view/secretaria/turmaPHP/consulTurma.php"); // Redireciona de volta para a página de consulta
exit();
?>
