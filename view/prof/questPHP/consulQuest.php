<?php
//session_start();
require_once '../../../model/conexao.php';
session_start();

if (!isset($_SESSION["codProfessor"])) {
    echo "Você não está logado.";
    exit;
}
$conn = new conexao();

// Buscar todos os questionários cadastrados
$questionario = $conn->getQuestionario();

$codProfessor = $_SESSION["codProfessor"];
$titulos = $conn->exibiQuestionario($codProfessor);
//var_dump($questionario);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/consultas.css">
    <title>Consulta Questionários | Ensino Amigo</title>
</head>
<body>
<section>
        <!-- Linha superior com ícones de perfil e redes sociais -->
        <div class="linhaVermelha">
        </div>

        <!-- Elemento gráfico (arco-íris) no canto superior -->
        <div class="arcoIris">
            <div class="azul"></div>
            <div class="amarelo"></div>
            <div class="vermelho"></div>
        </div>

        <!-- Início da Navbar -->
        <nav>
            <div class="nav-content">
                <!-- Botão para a página de Alunos -->

                <!-- Botão para a página inicial -->
                <div class="button">
                    <a href="../inicioProf.php">
                        <button class="btnInicio btnNav">Início</button>
                    </a>
                </div>

                <!-- Dropdown para cadastro -->
                <div class="dropdown">
                    <a href="#">
                        <button class="btnCads btnNav">Questionario</button>
                    </a>
                </div>

                <div class="dropdown">
                    <a href="../iniciarQuest.php">
                        <button class="btnQuest btnNav">Dê o play</button>
                    </a>
                </div>

                <div class="dropdown">
                    <a href="../../../login.php">
                        <button class="btnAmarelo btnNav">Sair</button>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Fim da Navbar -->

        <!-- Conteúdo principal -->
        <main>
            <!-- Modal para edição -->
            <div class="modal-overlay" id="modal">
                <div class="modal-content">
                    <!-- Formulário de edição do enunciado e título -->
                    <form>
                        <p>Título Enunciado</p>
                        <input type="text" placeholder="Digite o Título..."><br><br>
                        <p>Enunciado</p>
                        <textarea placeholder="Digite o enunciado..." rows="5"></textarea><br><br>
                    </form>

                    <!-- Formulário de alternativas -->
                    <form>
                        <p>Alternativa 01</p>
                        <label class="radio-label">
                            <input type="radio" name="alternativa" />
                            <input type="text" placeholder="Digite a questão...">
                        </label><br><br>

                        <p>Alternativa 02</p>
                        <label class="radio-label">
                            <input type="radio" name="alternativa" />
                            <input type="text" placeholder="Digite a questão...">
                        </label><br><br>

                        <p>Alternativa 03</p>
                        <label class="radio-label">
                            <input type="radio" name="alternativa" />
                            <input type="text" placeholder="Digite a questão...">
                        </label><br><br>

                        <p>Alternativa 04</p>
                        <label class="radio-label">
                            <input type="radio" name="alternativa" />
                            <input type="text" placeholder="Digite a questão...">
                        </label>

                        <!-- Botões de adicionar e excluir alternativa -->
                        <button type="button" class="btnCad btnAzul">+</button>
                        <button type="button" class="btnCad btnLixeira"><img src="../../image/lixo.png" alt="Lixeira"></button>
                    </form>

                    <br/>

                    <!-- Botões de alterar e fechar modal -->
                    <button type="button" class="btnList btnListVerde" onclick="openModal()">Alterar</button>
                    <button class="btnList btnListVermelho" onclick="closeModal()">Fechar</button>
                </div>
            </div>

            <!-- Lista de questionários -->
            <div class="distance">
                <div class="box" id="mainBox">
                    <h2>Consulta Questionários</h2>
                        <button class="btnNav btnAzul" onclick="moveBox()">Adicionar Questionário</button>
                            <br/><br/>
                            <span>Questionários Cadastrados</span>
                                <div class="consul-list">
                                    <?php foreach ($questionario as $item): ?>
                                        <div class="consu-item">
                                            <b>Título:</b><br>
                                                <?php echo htmlspecialchars($item['titulo']); ?>
            
                                                    <div class="button-group">
                                                    <?php
                            if ($titulos && count($titulos) > 0) {
                                echo "<table>";
                                echo "<tr><th>Título</th><th>Ação</th></tr>";

                                foreach ($titulos as $titulo) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($titulo['titulo']) . "</td>";
                                    echo "<td>
                                            <form action='../../aluno/selecionarTurma.php' method='post'>
                                                <input type='hidden' name='codQuestionario' value='" . htmlspecialchars($titulo['codQuestionario']) . "' />
                                                <button type='submit' class='btnList btnListAzul'>Iniciar</button>
                                                
                                                
                                            </form>
                                             <form action='../excluiQuestionario.php' method='get'>
                                             <input type='hidden' name='codQuestionario' value='" . htmlspecialchars($titulo['codQuestionario']) . "' />
                                            <button type='submit' class='btnList btnListVermelho'>Remover</button>
                                            </form>
                                            
                                        </td>";
                                    echo "</tr>";
                                    
                                }
                                echo "</table>";
                            } else {
                                echo "<p>Nenhum questionário encontrado.</p>";
                            }
                            ?>
                                                        <button type="button" class="btnList btnListVerde" onclick="openModal()">Alterar</button>
                                                        
                                                    </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                        <!-- Repita o mesmo bloco para mais questionários -->
                    </div>
                </div>

                <!-- 
                    //session_start();
                //require_once '../model/conexao.php';

                    //$db = new conexao();
                    //$cod = $questionario['codQuestionario'];
                // Buscar todos os questionários cadastrados
                
                //$a = $questionario[0]['codQuestionario'];
                //var_dump($a);
                    //$quest = $db->getNomeQuestionario($questionario['codQuestionario']);
                    -->
                

                <!-- Formulário para cadastro de questionário -->
                <div class="cadastro-box" id="cadastroBox">
                    <h2>Questionário</h2>
                    <div class="rowQuest">
                        <form action="../../../controller/recebeQuest.php" method="post">
                            <p>Título Enunciado</p>
                            <input type="text" placeholder="Digite o título..." name="txtTituloEnunciado" required><br><br>
                            </br>
                            
                            <p>Enunciado</p>
                            <input type="text" placeholder="Digite o enunciado..." name="txtEnunciado" required><br><br>
                            <center>

                            <?php foreach ($questionario as $index): ?>

                                <a href="consulQuest2.php?id_up=<?php echo htmlspecialchars($index['codQuestionario']);?>">
                                <?php endforeach ?>

                                    <button type="submit" class="btnListCenter btnListVerde">Salvar</button>
                                </a>
                           
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <!-- Script para mover box -->
    <script>
        function moveBox() {
            // Move a primeira box para o canto esquerdo
            const mainBox = document.getElementById('mainBox');
            mainBox.classList.add('right');

            // Mostra a box de cadastro
            const cadastroBox = document.getElementById('cadastroBox');
            cadastroBox.classList.add('active');
        }
    </script>

    <!-- Script para abrir e fechar o modal -->
    <script>
        function openModal() {
            document.getElementById('modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        document.querySelectorAll('.btnExcluir').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const confirmDelete = confirm("Tem certeza que deseja excluir este aluno?");
            if (confirmDelete) {
                window.location.href = "excluiQuestionario.php?id=" + id;
            }
        });
    });
    </script>
</body>
</html>
