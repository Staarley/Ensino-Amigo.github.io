<?php
session_start();
require_once("../model/conexao.php");

$conn = new Conexao();
$pdo = $conn->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeTurma = $_POST['nomeTurma'];
    $numeroAlunos = $_POST['numero'];
    $codProfessor = $_POST['codProfessor']; // Recebe o código do professor selecionado

    if (!empty($nomeTurma) && !empty($numeroAlunos) && !empty($codProfessor)) {
        try {
            // Insere a turma com o professor selecionado
            $query = "INSERT INTO turma (nomeTurma, numeroAlunos, codProfessor) VALUES (:nomeTurma, :numeroAlunos, :codProfessor)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nomeTurma', $nomeTurma);
            $stmt->bindParam(':numeroAlunos', $numeroAlunos);
            $stmt->bindParam(':codProfessor', $codProfessor);

            $stmt->execute();

            $_SESSION['success_message'] = 'Turma cadastrada com sucesso!';
            header("Location: ../view/secretaria/turmaPHP/consulTurma.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Erro ao cadastrar turma: ' . $e->getMessage();
            header("Location: ../view/secretaria/turmaPHP/consulTurma.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
        header("Location: ../view/secretaria/turmaPHP/consulTurma.php");
        exit();
    }
}
?>
