<?php
require_once("../model/conexao.php"); // Inclui a classe de conexão
session_start(); // Inicia a sessão

$conn = new Conexao(); // Cria uma nova instância da classe Conexao

$email = $_POST['email']; // Obtém o email do formulário
$senha = $_POST['senha']; // Obtém a senha do formulário

if ($conn->autentica($email, $senha)) {
    $_SESSION["email"] = $email; // Armazena o email na sessão
    $_SESSION["codProfessor"] = $conn->getCodProfessor($email); // Armazena o código do professor
    echo "<script Language='javascript'> window.location.href='../../../index.php'</script>"; // Redireciona para a página inicial
} else {
    // Exibe mensagem de erro se a autenticação falhar
    echo "<script Language='javascript'>
            alert('Email ou senha incorretos');
            window.location.href='../../index.php';
          </script>";
}
?>
