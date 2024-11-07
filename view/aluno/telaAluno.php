<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/telaAluno.css">
    <title>Questionários Ativos</title>
</head>
<body>

    <div class="container">
        <div class="linhaVermelha"></div>

        <nav>
            <button class="btnAmarelo btnNav"><a href="../login/loginAluno.php">Sair do portal do aluno</a></button>
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

        <div class="areaLogo">
            <img src="../img/logo.ico" alt="Logo Ensino Amigo" title="Logo Ensino Amigo" class="logo">
            <h2 class="lblBemVindo">Bem vindo</h2>
        </div>

        <div class="areaQuest">
            <?php
            require_once("../../model/conexao.php");
            session_start();

            if (!isset($_SESSION["codAluno"])) {
                echo "<p>Acesso negado. <a href='loginAluno.html'>Clique aqui para fazer login.</a></p>";
                exit;
            }

            if (!isset($_SESSION["codTurma"])) {
                echo "<p>Erro: turma não definida. <a href='loginAluno.html'>Clique aqui para fazer login.</a></p>";
                exit;
            }

            $conn = new Conexao();
            $codTurma = $_SESSION["codTurma"];

            $query = "SELECT q.codQuestionario, q.titulo FROM questionario q
                      JOIN turma_questionario tq ON q.codQuestionario = tq.codQuestionario
                      WHERE tq.codTurma = :codTurma AND tq.status = 1";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':codTurma', $codTurma);
            $stmt->execute();
            
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($resultados) > 0) {
                foreach ($resultados as $linha) {
                    $codQuestionario = htmlspecialchars($linha['codQuestionario']);
                    $titulo = htmlspecialchars($linha['titulo']);
                    echo "<div class='cardQuestionario'>
                            <div class='foto'>
                                <img id='personagemImg1' alt=''>
                                <div class='arcoIrisCard'>
                                    <div class='azulCard'>
                                        <div class='amareloCard'>
                                            <div class='vermelhoCard'>
                                                <div class='brancoCard'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='descricao'>
                                <h2 class='nomeQuestionario'>$titulo</h2>
                                <a href='realizarQuestionario.php?codQuestionario=$codQuestionario' class='btnIniciarQuestionario'>Iniciar questionário</a>
                            </div>
                        </div>";
                }
            } else {
                echo "<p>Não há questionários disponíveis para esta turma.</p>";
            }
            ?>
        </div>
    </div>

    <script>
        function escolherPersonagem() {
            const nomes = ["beto", "cacheado", "carlos", "chico", "fernando", "ingrid", "julia", "lara", "mariana", "miguel", "samuel", "sophia"];
            return nomes[Math.floor(Math.random() * nomes.length)];
        }

        document.getElementById("personagemImg1").src = `../img/${escolherPersonagem()}.png`;
    </script>

</body>
</html>