<?php
require_once("../../model/conexao.php");
session_start();

// Verifica se o aluno está autenticado
if (!isset($_SESSION["codAluno"])) {
    echo "<p>Acesso negado. <a href='../../../index.php'>Clique aqui para fazer login.</a></p>";
    exit;
}

$conn = new Conexao();
$codAluno = $_SESSION["codAluno"];
$codQuestionario = isset($_GET['codQuestionario']) ? intval($_GET['codQuestionario']) : 0;
$perguntaAtual = isset($_GET['perguntaAtual']) ? intval($_GET['perguntaAtual']) : 1;

// Verifica se o questionário é válido
$questionario = $conn->getQuestionarioById($codQuestionario);
if (!$questionario) {
    echo "<p>Questionário não encontrado ou inativo.</p>";
    exit;
}

// Obtém as perguntas do questionário e calcula o total de perguntas
$perguntas = $conn->getPerguntasDoQuestionario($codQuestionario);
$totalPerguntas = count($perguntas);

if ($perguntaAtual > $totalPerguntas || $perguntaAtual < 1) {
    echo "<p>Página de pergunta inválida.</p>";
    exit;
}

// Seleciona a pergunta atual
$pergunta = $perguntas[$perguntaAtual - 1];
$alternativas = $conn->getAlternativasDaPergunta($pergunta['codPerguntas']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Questionário - Pergunta <?php echo $perguntaAtual; ?></title>

    <link rel="stylesheet" href="../css/realizarQuestStyle.css">
</head>
<body>
    <div class="container">
        <div class="linhaVermelha"></div>
        <nav><button class="btnSairAluno">Sair do questionário</button></nav>

        <div class="arcoIris">
            <div class="azul">
                <div class="amarelo">
                    <div class="vermelho">
                        <div class="branco">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <img src="../img/logomenor.png" alt="" class="logoMenor">
        <div class="areaQuest">
        
        <img src="../img/questionario.png" alt="" class="imgQuestionario">
        <h1><?php echo htmlspecialchars($questionario['titulo']); ?></h1>


            <form action="salvarRespostas.php" method="POST">
            <input type="hidden" name="codQuestionario" value="<?php echo $codQuestionario; ?>">
            <input type="hidden" name="codPergunta" value="<?php echo $pergunta['codPerguntas']; ?>">
            <input type="hidden" name="perguntaAtual" value="<?php echo $perguntaAtual; ?>">

                <div class="areaAltern">
                <p><strong class="pergunta"><span class="numeroPergunta"><?php echo htmlspecialchars("Pergunta 0" . $pergunta['numeroPergunta']); ?> <br><br></span> <?php echo htmlspecialchars($pergunta['pergunta']); ?></strong></p>

                    <?php foreach ($alternativas as $alternativa): ?>
                        <label>
                            <input type="radio" name="resposta" value="<?php echo $alternativa['codAlternativa']; ?>" required>
                            <?php echo htmlspecialchars($alternativa['alternativa']); ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
                
                <div>
                    <?php if ($perguntaAtual < $totalPerguntas): ?>
                        <button type="submit" name="proximaPergunta">Próxima Pergunta</button>
                    <?php else: ?>
                        <button type="submit" name="finalizar">Enviar Respostas</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
