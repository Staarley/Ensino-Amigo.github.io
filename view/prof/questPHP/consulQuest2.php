<?php
//session_start();

//var_dump($_SESSION); 

// Verificar se o ID do questionário existe na sessão
//if (!isset($_SESSION['id_questionario'])) {
//    die("ID do questionário não encontrado.");
//}

//$cod = $_SESSION['id_questionario'];

require_once '../../../model/conexao.php';
$db = new conexao();


// Na página de destino
if (isset($_GET['lastId'])) {
    $cod = $_GET['lastId'];
    
}
// Obter os detalhes do questionário (caso necessário)
$codNome = $db->getNomeQuestionario($cod);
$questionario = $db->getQuestionario();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/cadQuest.css">
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
                        <button class="btnCadastro btnNav">Questionario</button>
                    </a>
                </div>

                <div class="dropdown">
                    <a href="iniciarQuest.php">
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
            <!-- Modal -->
            <div class="modal-overlay" id="modal">
                <div class="modal-content">
                    <form>
                        <p>Título do Enunciado</p>
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

                        <!-- Botões de adicionar e remover alternativa -->
                        <button type="button" class="btnCad btnAzul">+</button>
                        <button type="button" class="btnCad btnLixeira"><img src="../../image/lixo.png" alt="Lixeira"></button>
                    </form>

                    <br/>

                    <!-- Botões para alterar e fechar modal -->
                    <button type="button" class="btnList btnListVerde" onclick="openModal()">Alterar</button>
                    <button class="btnList btnListVermelho" onclick="closeModal()">Fechar</button>
                </div>
            </div>

            <!-- Seção de listagem de questionários -->
            <div class="distance">
                <div class="box right" id="mainBox">
                    <h2>Consulta Questionários</h2>
                    <button class="btnNav btnAzul" onclick="moveBox()">Adicionar Alunos</button>
                    <br/><br/>
                    <span>Questionários Cadastrados</span>

                    <div class="consul-list">
                                    <?php foreach ($questionario as $item): ?>
                                        <div class="consu-item">
                                            <b>Título:</b><br>
                                                <?php echo htmlspecialchars($item['titulo']); ?>
            
                                                    <div class="button-group">
                                                        <button type="button" class="btnList btnListAzul">Iniciar</button>
                                                        <button type="button" class="btnList btnListVerde" onclick="openModal()">Alterar</button>
                                                        <button type="button" class="btnList btnListVermelho">Remover</button>
                                                    </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                </div>

                <!-- Caixa de cadastro de questionários -->
                <div class="cadastro-box" id="cadastroBox">
                    <h2>Questionário</h2>
                    <div class="rowQuest">
                        <form action="../../../controller/recebePergunta.php" method="post">

                            <p>Número da pergunta:</p>
                            <input type="text" placeholder="Insira o número da pergunta..." name="txtNumPergunta"  id="numPergunta" required><br><br>

                            <p>Pergunta:</p>
                            <textarea placeholder="Digite a pergunta..." rows="5" name="txtPergunta" id="pergunta" required></textarea><br><br>

                            <input type="hidden" id="codQuestionario" name="codQuestionario" value="<?php echo $cod; ?>">

                            <center>
                                <a href="consulQuest3.php">
                                    <button type="submit" class="btnListCenter btnListVerde">Salvar</button>
                                </a>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <!-- Script para mover caixas -->
    <script>
        function moveBox() {
            // Move a primeira box para o canto direito
            const mainBox = document.getElementById('mainBox');
            mainBox.classList.add('right');

            // Exibe a caixa de cadastro
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
    </script>
</body>
</html>
