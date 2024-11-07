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
$codQuestionario = $_POST['codQuestionario'] ?? 0;
$codPergunta = $_POST['codPergunta'] ?? 0;
$codAlternativa = $_POST['resposta'] ?? 0;
$perguntaAtual = $_POST['perguntaAtual'] ?? 1;

// Obtém data e hora atuais
$dataAtual = date("Y-m-d");
$horaAtual = date("H:i:s");

// Determina se a resposta está correta
$alternativaCorreta = $conn->getAlternativaCorreta($codPergunta);
$acerto = ($alternativaCorreta['codAlternativa'] == $codAlternativa) ? 1 : 0;

// Insere a resposta do aluno no banco de dados
$sql = "INSERT INTO respostas (codAluno, codPerguntas, codAlternativa, acerto, data, hora, codQuestionario)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$codAluno, $codPergunta, $codAlternativa, $acerto, $dataAtual, $horaAtual, $codQuestionario]);

// Redireciona para a próxima pergunta ou finaliza o questionário
$totalPerguntas = count($conn->getPerguntasDoQuestionario($codQuestionario));
if ($perguntaAtual < $totalPerguntas) {
    header("Location: realizarQuestionario.php?codQuestionario={$codQuestionario}&perguntaAtual=" . ($perguntaAtual + 1));
    exit;
} else {
    echo "<p>Questionário finalizado com sucesso! Suas respostas foram salvas.</p>";
    echo "<a href='telaAluno.php'>Voltar para Questionários</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="salvarRespostaStyle.css">

    <title>Cadastro</title>
</head>
<body>

    <script type="text/javascript" src="/view/js/telaCadastro.js"></script>

    <div class="container">
        <div class="linhaVermelha"></div>

        <nav>
            <button class="btnAluno"><a href="">Alunos</a></button>
            <button class="btnInicio"><a href="">Inicio</a></button>

            <div class="btnCadastro">
                <a href="#">Cadastros</a>
                <ul class="lstCadastros">
                    <li><a href="#">Cadastro de Alunos</a></li>
                    <li><a href="#">Cadastro de Professores</a></li>
                </ul>
            </div>

            <button class="btnIniciaQuestionario"><a href="">Iniciar questionário</a></button>
            <button class="btnSair"><a href="">Sair</a></button>

        </nav>
        
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

    </div>

</body>
</html>
