<?php
session_start();
require_once("../model/conexao.php");

$conn = new Conexao(); 
$pdo = $conn->getConnection();

if (!isset($_SESSION['codSecretaria'])) {
    die("Erro: Você não tem permissão para cadastrar professores.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmaSenha = $_POST['confirmaSenha'];
    $codSecretaria = $_SESSION['codSecretaria'];
    $codProfessor = $_POST['codProfessor'] ?? null;

    if ($senha !== $confirmaSenha) {
        die("Erro: As senhas não coincidem.");
    }

    try {
        if (!empty($codProfessor)) {
            $query = "UPDATE professores SET nome = :nome, email = :email, senha = :senha WHERE codProfessor = :codProfessor";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':codProfessor', $codProfessor);
        } else {
            $query = "INSERT INTO professores (nome, email, senha, codSecretaria) VALUES (:nome, :email, :senha, :codSecretaria)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':codSecretaria', $codSecretaria);
        }

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
            echo "Professor cadastrado/atualizado com sucesso!";
            echo "<script> window.location.href='../view/secretaria/profPHP/consulProf.php'; </script>";
        } else {
            echo "Erro ao cadastrar/atualizar professor.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
