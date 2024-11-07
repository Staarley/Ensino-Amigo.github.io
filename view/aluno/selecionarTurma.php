<?php
require_once("../../model/conexao.php");
session_start();

if (!isset($_SESSION["codProfessor"]) || !isset($_POST["codQuestionario"])) {
    echo "Acesso negado.";
    exit;
}

$codQuestionario = $_POST["codQuestionario"];
$conn = new Conexao();

// Obtém o codProfessor da sessão
$codProfessor = $_SESSION["codProfessor"];

// Passa o codProfessor para o método selectTurma
$turmas = $conn->selectTurma($codProfessor);
$tituloQuestionario = $conn->getQuestionarioTitulo($codQuestionario);

if (!$tituloQuestionario) {
    echo "Questionário não encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Turma</title>
</head>
<body>
    <h1>Selecionar Turma para o Questionário</h1>
    <h2><?php echo htmlspecialchars($tituloQuestionario); ?></h2>
    
    <form action="../model/processarTurma.php" method="post">
    <input type="hidden" name="codQuestionario" value="<?php echo htmlspecialchars($codQuestionario); ?>" />
    <label for="turma">Escolha a Turma:</label>
    <select name="codTurma" id="turma" required>
        <option value="">Selecione uma turma</option>
        <?php foreach ($turmas as $turma): ?>
            <option value="<?php echo htmlspecialchars($turma['codTurma']); ?>"><?php echo htmlspecialchars($turma['nomeTurma']); ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Iniciar Questionário</button>
</form>
</body>
</html>
