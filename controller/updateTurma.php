<?php
session_start(); // Inicia a sessão para acessar as variáveis de sessão
require_once("conexao.php"); // Inclui a classe de conexão com o banco de dados

$conn = new Conexao(); // Cria uma nova instância da classe Conexao
$pdo = $conn->getConnection(); // Obtém a conexão com o banco de dados

// Verifica se o professor está autenticado
if (!isset($_SESSION['codProfessor'])) {
    die("Erro: Você não está logado."); // Termina a execução se não estiver logado
}

$codProfessor = $_SESSION['codProfessor']; // Obtém o código do professor da sessão

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeTurma = $_POST['nomeTurma']; // Obtém o nome da turma do formulário
    $numeroAlunos = $_POST['numeroAlunos']; // Obtém o número de alunos do formulário
    $codTurma = $_POST['codTurma']; // Obtém o código da turma do formulário

    // Obtendo codProfessor da sessão
    $codProfessor = $_SESSION['codProfessor']; // Obtém novamente o código do professor

    // Verifica se um código de turma foi fornecido
    if (!empty($codTurma)) {
        // Atualiza uma turma existente
        $query = "UPDATE turma SET nomeTurma = :nomeTurma, numeroAlunos = :numeroAlunos, codProfessor = :codProfessor WHERE codTurma = :codTurma";
        $stmt = $pdo->prepare($query); // Prepara a query para atualização
        $stmt->bindParam(':nomeTurma', $nomeTurma); // Liga o parâmetro nomeTurma
        $stmt->bindParam(':numeroAlunos', $numeroAlunos); // Liga o parâmetro numeroAlunos
        $stmt->bindParam(':codProfessor', $codProfessor); // Liga o parâmetro codProfessor
        $stmt->bindParam(':codTurma', $codTurma); // Liga o parâmetro codTurma
    } else {
        // Insere uma nova turma se não houver código de turma
        $query = "INSERT INTO turma (nomeTurma, numeroAlunos, codProfessor) VALUES (:nomeTurma, :numeroAlunos, :codProfessor)";
        $stmt = $pdo->prepare($query); // Prepara a query para inserção
        $stmt->bindParam(':nomeTurma', $nomeTurma); // Liga o parâmetro nomeTurma
        $stmt->bindParam(':numeroAlunos', $numeroAlunos); // Liga o parâmetro numeroAlunos
        $stmt->bindParam(':codProfessor', $codProfessor); // Liga o parâmetro codProfessor
    }

    // Executa a query e verifica se a operação foi bem-sucedida
    if ($stmt->execute()) {
        echo "Turma cadastrada/atualizada com sucesso!"; // Mensagem de sucesso
        echo "<script Language='javascript'>
        window.location.href='../view/cadTurmas.php'; // Redireciona para a página de cadastro de turmas
      </script>";
    } else {
        echo "Erro ao cadastrar/atualizar turma."; // Mensagem de erro se a operação falhar
    }
}
?>
