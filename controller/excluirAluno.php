<?php
session_start(); // Inicia a sessão
require_once("../model/conexao.php"); // Inclui a classe de conexão

$conn = new Conexao(); // Cria uma nova instância da classe Conexao

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtém o ID do aluno a ser excluído

    try {
        $conn->excluirAluno($id); // Chama o método para excluir o aluno
        // Redireciona de volta para a página de cadastro de turmas
        header("Location: ../view/cadTurmas.php?codTurma=" . $_SESSION["codTurma"]);
        exit();
    } catch (Exception $e) {
        echo "Erro ao excluir aluno: " . $e->getMessage(); // Exibe mensagem de erro se ocorrer uma exceção
    }
} else {
    echo "ID do aluno não fornecido."; // Mensagem se o ID não for fornecido
}
?>
