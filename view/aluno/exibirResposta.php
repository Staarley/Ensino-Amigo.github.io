<?php
session_start();
require_once '../../model/conexao.php';

$conexao = new Conexao();

$codAluno = $_GET['codAluno'] ?? null;
$codQuestionario = $_GET['codQuestionario'] ?? null;

if (!$codAluno || !$codQuestionario) {
    echo "Parâmetros não recebidos.";
    exit;
}

// Busca as respostas do aluno para o questionário especificado
$respostas = $conexao->getRespostasAluno($codAluno, $codQuestionario);

// Verifica se existem respostas retornadas
if ($respostas) {
    echo "<h1>Respostas do Aluno</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Pergunta</th><th>Resposta</th><th>Acertou?</th></tr>";
    
    foreach ($respostas as $resposta) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($resposta['pergunta']) . "</td>"; // Exibindo a pergunta
        
        echo "<td>" . htmlspecialchars($resposta['alternativa']) . "</td>"; 
        echo "<td>" . ($resposta['acerto'] ? 'Sim' : 'Não') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nenhuma resposta encontrada para este aluno no questionário.</p>";
}

?>
