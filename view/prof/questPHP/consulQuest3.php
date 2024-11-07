<?php

require_once '../../../model/conexao.php';
$db = new conexao();

// As consultas de questionários
//$questionario = $db->getQuestionario();

// Pega o ID da última pergunta cadastrada
$pergunta = $db->getId();

if ($pergunta !== null) {
    // Usa o ID retornado para buscar os detalhes da pergunta
    $codNome = $db->getNomePergunta($pergunta);

// Exibe os resultados
// echo "<pre>";
//print_r($codNome);
//echo "</pre>";

} else {
    echo "Nenhuma pergunta encontrada.";
}
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
                    <p>Titulo Enunciado</p>
                    <input type="text" placeholder="Digite o Titulo..."><br><br>
                    <p>Enunciado</p>
                    <textarea placeholder="Digite o enunciado..." rows="5"></textarea><br><br>
                </form>

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

                
                        <button type="button" class="btnCad btnAzul">+</button>
                        <button type="button" class="btnCad btnLixeira"><img src="../../image/lixo.png" alt="Lixeira"></button>
                </form>

                    <br/>

                        <button type="button" class="btnList btnListVerde" onclick="openModal()">Alterar</button>
                        <button class="btnList btnListVermelho" onclick="closeModal()">Fechar</button>
            </div>
        </div>


            
            <div class="distance">
                <div class="box right" id="mainBox">
                    <h2>Consulta Questionarios</h2>
                    <button class="btnNav btnAzul" onclick="moveBox()">Adicionar Alunos</button>
                    <br/><br/>
                    <span>Questionarios Cadastrados</span>

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

        <!-- Cadastro das alternativas -->

                <div class="cadastro-box" id="cadastroBox">
                    <h2>Questionario</h2>
                    <div class="rowQuest">
                            
                        <form action="../../../controller/recebeAlternativa.php" method="post">
                            <p>Alternativa 01</p>
                            <label class="radio-label">
                                <input type="radio" id="radio1" name="correta" value="1">
                                <input type="text" placeholder="Insira a alternativa..." name="txtAlternativa1" id="alternativa1" required>
                            </label><br><br>

                            <p>Alternativa 02</p>
                            <label class="radio-label">
                                <input type="radio" id="radio2" name="correta" value="2">
                                <input type="text" placeholder="Insira a alternativa..." name="txtAlternativa2" id="alternativa2" required>
                            </label><br><br>

                            <p>Alternativa 03</p>
                            <label class="radio-label">
                                <input type="radio" id="radio3" name="correta" value="3">
                                <input type="text" placeholder="Insira a alternativa..." name="txtAlternativa3" id="alternativa3" required>
                            </label><br><br>

                            <p>Alternativa 04</p>
                            <label class="radio-label">
                                <input type="radio" id="radio4" name="correta" value="4"><br/><br/>
                                <input type="text" placeholder="Insira a alternativa..." name="txtAlternativa4" id="alternativa4" required>
                            </label><br><br>

                            <input type="hidden" id="codQuestionario" name="codQuestionario" value="<?php echo $pergunta; ?>">

                            <a href="consulQuest2.php">
                                <button type="submit" class="btnCad btnVerde">Meu questionário está pronto!</button>
                            </a>

                            <!-- botão btnCad btnAzul ainda não funcional -->

                            <a href="consulQuest2.php?codQuestionario=<?php echo $pergunta; ?>">
                                <button type="button" class="btnCad btnAzul">Adicionar mais uma pergunta.</button>
                            </a>
                                <button type="button" class="btnCad btnLixeira"><img src="../../image/lixo.png" alt="Lixeira"></button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>

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
    </script>
</body>
</html>
