<?php
session_start();
require_once("../model/conexao.php");

$conn = new Conexao(); 
$pdo = $conn->getConnection(); 

// Se a requisição for POST, tenta atualizar os dados do professor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codProfessor = $_POST['codProfessor'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Recupera o codSecretaria atual do professor antes de fazer a atualização
    $stmt = $pdo->prepare("SELECT codSecretaria FROM professores WHERE codProfessor = :codProfessor");
    $stmt->bindParam(':codProfessor', $codProfessor);
    $stmt->execute();
    $professor = $stmt->fetch(PDO::FETCH_ASSOC);
    $codSecretaria = $professor['codSecretaria']; // Mantém o valor atual de codSecretaria

    try {
        // Atualiza os dados do professor, mantendo o codSecretaria atual
        $stmt = $pdo->prepare("UPDATE professores 
                               SET nome = :nome, 
                                   email = :email, 
                                   senha = :senha,
                                   codSecretaria = :codSecretaria
                               WHERE codProfessor = :codProfessor");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':codSecretaria', $codSecretaria); // Não modifica o codSecretaria
        $stmt->bindParam(':codProfessor', $codProfessor);

        $stmt->execute();

        // Redireciona após a atualização
        header("Location: ../view/secretaria/profPHP/consulProf.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao atualizar dados do professor: " . $e->getMessage();
    }
}
?>
