<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionários Respondidos</title>
    <link rel="stylesheet" href="../css/questionarioRespondidoStyle.css">
</head>
<body>
<div class="container">
    <div class="linhaVermelha"></div>
    <nav>
        <button class="btnAluno"><a href="">Alunos</a></button>
        <button class="btnInicio"><a href="">Inicio</a></button>

        <div class="btnCadastro">
            <a href="#">Cadastros</a>
            <ul class="lstCadastros">
                <li><a href="#">Cadastro de Questionario</a></li>
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

    <img src="../img/logomenor.png" alt="Logo Ensino Amigo" class="logo">

    <!-- Questionários Respondidos -->
    <div class="areaSelect">
        <div class="areaConsulta">
            <?php
            session_start();
            require_once '../../model/conexao.php';

            $conexao = new Conexao();

            if (isset($_POST['codTurma'])) {
                $codTurma = $_POST['codTurma'];
                $respostas = $conexao->getRespostasTurma($codTurma);

                if ($respostas) {
                    echo "<h2>Questionários Respondidos</h2>";
                    echo "<table class='styledTable'>";
                    echo "<tr><th>Questionário</th><th>Visualização</th></tr>";

                    foreach ($respostas as $resposta) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($resposta['titulo']) . "</td>";
                        echo "<td>
                                <form action='exibirAlunos.php' method='POST'>
                                    <input type='hidden' name='codTurma' value='" . htmlspecialchars($codTurma) . "'>
                                    <input type='hidden' name='codQuestionario' value='" . htmlspecialchars($resposta['codQuestionario']) . "'>
                                    <button class='viewButton' type='submit'>Ver Alunos</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p class='message'>Nenhum questionário respondido para esta turma.</p>";
                }
            } else {
                echo "<p class='message'>Código da turma não recebido.</p>";
            }
            ?>
        </div>
    </div>

    <div class="areaPersonagens"></div>
</div>
</body>
</html>
