<?php
session_start();
require_once '../../model/conexao.php';

$conexao = new Conexao();

if (!isset($_SESSION["codProfessor"])) {
    echo "Usuário não autenticado.";
    exit;
}

if (isset($_POST['codTurma'])) {
    $codTurma = $_POST['codTurma'];
} else {
    echo "Código da turma não recebido.";
    exit;
}

$codQuestionario = $_POST['codQuestionario'] ?? null; // Obtém o codQuestionario se enviado

$alunos = $conexao->exibeAlunoPorTurma($codTurma);

if (empty($alunos)) {
    echo "Nenhum aluno encontrado.";
} else {
    echo "<h1>Alunos da Turma</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Nome</th><th>RA</th><th>Data de Nascimento</th><th>Ações</th></tr>";
    
    foreach ($alunos as $aluno) {
        // Verifica se 'codAluno' está definido no array do aluno
        if (isset($aluno['codAluno'])) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($aluno['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($aluno['ra']) . "</td>";
            echo "<td>" . htmlspecialchars($aluno['dataNascimento']) . "</td>";
            // Botão para exibir respostas
            echo "<td>
                    <form action='exibirResposta.php' method='GET'>
                        <input type='hidden' name='codAluno' value='" . htmlspecialchars($aluno['codAluno']) . "'>
                        <input type='hidden' name='codQuestionario' value='" . htmlspecialchars($codQuestionario) . "'>
                        <input type='submit' value='Exibir Respostas'>
                    </form>
                  </td>";
            echo "</tr>";
        } else {
            echo "<tr><td colspan='4'>Erro: 'codAluno' não encontrado.</td></tr>";
        }
    }
    
    echo "</table>";
}
?>
