<?php
session_start();
require_once("../model/conexao.php");

$conn = new Conexao(); 
$pdo = $conn->getConnection(); 

// Verifica se a secretaria está logada
if (!isset($_SESSION['codSecretaria'])) {
    die("Erro: Você não está logado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeAluno = $_POST['nome'];
    $dataNascimento = $_POST['dataNascimento'];
    $grauTEA = $_POST['grauTEA'];
    $codAluno = $_POST['codAluno'] ?? null; // Checagem condicional para evitar erro
    $codTurma = $_POST['turma'];
    $ra = $_POST['ra'] ?? null; // Captura o RA do formulário

    // Verifique se o RA foi preenchido
    if (empty($ra)) {
        die("Erro: O campo RA não pode estar vazio.");
    }

    // Pega o código da secretaria logada
    $codSecretaria = $_SESSION['codSecretaria']; 

    try {
        if (!empty($codAluno)) {
            // Atualizar aluno existente
            $query = "UPDATE aluno SET nome = :nomeAluno, dataNascimento = :dataNascimento, grauTEA = :grauTEA, codTurma = :codTurma, ra = :ra, codSecretaria = :codSecretaria WHERE codAluno = :codAluno";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nomeAluno', $nomeAluno);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':grauTEA', $grauTEA);
            $stmt->bindParam(':codTurma', $codTurma);
            $stmt->bindParam(':ra', $ra);
            $stmt->bindParam(':codSecretaria', $codSecretaria); // Associa a secretaria ao aluno
            $stmt->bindParam(':codAluno', $codAluno);
        } else {
            // Inserir novo aluno
            $query = "INSERT INTO aluno (nome, ra, dataNascimento, grauTEA, codTurma, codSecretaria) VALUES (:nomeAluno, :ra, :dataNascimento, :grauTEA, :codTurma, :codSecretaria)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nomeAluno', $nomeAluno);
            $stmt->bindParam(':ra', $ra);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':grauTEA', $grauTEA);
            $stmt->bindParam(':codTurma', $codTurma);
            $stmt->bindParam(':codSecretaria', $codSecretaria); // Associa a secretaria ao aluno
        }

        // Execute a consulta e verifique o resultado
        if ($stmt->execute()) {
            echo "Aluno cadastrado/atualizado com sucesso!";
            echo "<script>window.location.href='../view/secretaria/alunoPHP/consulAluno.php';</script>"; // Redireciona para a consulta de alunos
        } else {
            echo "Erro ao cadastrar/atualizar aluno.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
