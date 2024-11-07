<?php
require_once("../model/conexao.php"); 
session_start(); 

// Verifique se o professor está logado
if (!isset($_SESSION["codProfessor"])) {
    echo "Acesso negado."; 
    exit; 
}

// Verifique se o código do questionário foi passado via GET
if (isset($_GET["codQuestionario"])) {
    $codQuestionario = $_GET["codQuestionario"]; 
    $conn = new Conexao();

    // Verifique se o questionário existe
    $tituloQuestionario = $conn->getQuestionarioTitulo($codQuestionario);
    if (!$tituloQuestionario) {
        echo "Questionário não encontrado.";
        exit;
    }
} else {
    echo "Acesso negado. Questionário não especificado.";
    exit; 
}

// Verifique se o código da turma foi passado via GET
if (isset($_GET["codTurma"])) {
    $codTurma = $_GET["codTurma"];
} else {
    echo "Acesso negado. Turma não especificada.";
    exit; 
}

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["codQuestionario"]) || !isset($_POST["codTurma"])) {
        echo "Acesso negado."; 
        exit; 
    }

    $codQuestionario = $_POST["codQuestionario"]; 
    $codTurma = $_POST["codTurma"]; // Obtenha o codTurma do POST
    $conn = new Conexao();

    // Desativar o questionário
    if ($conn->desativarQuestionario($codQuestionario, $codTurma)) {
        echo "Questionário desativado com sucesso."; 
    } else {
        echo "Falha ao desativar o questionário."; 
    }
    exit; // Adicione isso para evitar exibir o restante da página após o processamento
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desativar Questionário</title>
</head>
<body>
    <h1>Desativar Questionário</h1>
    <p>Você deseja desativar o questionário: <?php echo htmlspecialchars($tituloQuestionario); ?>?</p>
    <form action="../model/desativarQuestionario.php" method="post">
        <input type="hidden" name="codQuestionario" value="<?php echo htmlspecialchars($codQuestionario); ?>" />
        <input type="hidden" name="codTurma" value="<?php echo htmlspecialchars($codTurma); ?>" />
        <button type="submit">Desativar Questionário</button>
    </form>
</body>
</html>
