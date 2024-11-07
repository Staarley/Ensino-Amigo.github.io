<?php
session_start(); // Inicia a sessão para acessar variáveis de sessão
require_once("../../../model/conexao.php"); // Inclui a classe de conexão

$conn = new Conexao(); // Cria uma nova instância da classe Conexao
$pdo = $conn->getConnection(); // Obtém a conexão

// Consulta para obter as turmas
$queryTurma = "SELECT codTurma, nomeTurma, numeroAlunos FROM turma"; 
$stmtTurma = $pdo->prepare($queryTurma);
$stmtTurma->execute(); // Executa a consulta para turmas

$turmas = $stmtTurma->fetchAll(PDO::FETCH_ASSOC); // Obtém todas as turmas em formato associativo

// Consulta para obter os professores
$queryProfessores = "SELECT codProfessor, nome FROM professores"; 
$stmtProfessores = $pdo->prepare($queryProfessores);
$stmtProfessores->execute(); // Executa a consulta para professores

$professores = $stmtProfessores->fetchAll(PDO::FETCH_ASSOC); // Obtém todos os professores em formato associativo
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/consultas.css">
    <title>Consulta Turmas | Ensino Amigo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Importando jQuery -->
</head>
<body>


<section>
        <!-- Linha vermelha com ícones e perfil -->
        <div class="linhaVermelha">
        </div>

        <!-- Elementos de arco-íris -->
        <div class="arcoIris">
            <div class="azul"></div>
            <div class="amarelo"></div>
            <div class="vermelho"></div>
        </div>

        <!-- Navbar -->
        <nav>
            <div class="nav-content">
                <div>
                    <a href="../boletim.php">
                        <button class="btnAlunos btnNav">Alunos</button>
                    </a>
                </div>

                <div>
                    <a href="../inicioSec.php">
                        <button class="btnInicio btnNav">Início</button>
                    </a>
                </div>

                <div class="dropdown">
                    <button class="btnCadastro btnNav">Cadastro</button>
                    <div class="dropdown-content cadastro-dropdown">
                        <a href="../profPHP/consulProf.php">Professores</a>
                        <a href="../alunoPHP/consulAluno.php">Alunos</a>
                        <a href="#">Turmas</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a href="../../../login.php">
                        <button class="btnAmarelo btnNav">Sair</button>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Fim da navbar -->

        <main>
            <!-- Modal -->
            <div class="modal-overlay" id="modal">
                <div class="modal-content">
                    <form>
                        <!-- Nome da turma -->
                        <p>Nome da Turma</p>
                        <input type="text" placeholder="Digite o nome da Turma..."><br><br>

                        <!-- Seleção de aluno para adicionar à turma -->
                        <p>Adicionar Aluno</p>
                        <select placeholder="Selecione os Alunos..." rows="5">
                            <option>Nenhum</option>
                            <option>Aluno 1</option>
                            <option>Aluno 2</option>
                            <option>Aluno 3</option>
                            <option>Aluno 4</option>
                        </select><br><br>

                        <!-- Lista de turmas com opção de remover -->
                        <p>Lista de Turmas</p>
                        <div class="turmas-list">
                            <div class="turma-item">
                                Turma 1
                                <button type="button" class="btnList btnListVermelho">Remover</button>
                            </div>
                            <div class="turma-item">
                                Turma 2
                                <button type="button" class="btnList btnListVermelho">Remover</button>
                            </div>
                            <div class="turma-item">
                                Turma 3
                                <button type="button" class="btnList btnListVermelho">Remover</button>
                            </div>
                            <div class="turma-item">
                                Turma 4
                                <button type="button" class="btnList btnListVermelho">Remover</button>
                            </div>
                        </div><br>
                        
                        <!-- Botões de ação no modal -->
                        <button class="btnList btnListVerde">Salvar</button>
                        <button type="button" class="btnList btnListVermelho" onclick="closeModal()">Fechar</button>
                    </form>
                </div>
            </div>

            <div class="distance">
                <div class="box" id="mainBox">
                    <h2>Consulta Turmas</h2>
                        <button class="btnNav btnAzul" onclick="moveBox()">Adicionar Questionário</button>
                        <br/><br/>
                        <span>Turmas Cadastradas</span>
                        <div class="consul-list">
                            <?php foreach ($turmas as $turma): ?> 
                                <div class="consu-item">
                                    <b>Turma:</b>
                                    <?php echo htmlspecialchars($turma['nomeTurma']); ?>

                                    <b>Quantidade de alunos:</b><br>
                                    <?php echo htmlspecialchars($turma['numeroAlunos']); ?>
                                    
                                    <div class="button-group">
                                        <!-- Ao clicar no botão, chama o deleteTurma.php e passa o codTurma pela URL -->
                                        <a href="../../../controller/excluirTurma.php?codTurma=<?php echo $turma['codTurma']; ?>" 
                                        class="btnList btnListVermelho" 
                                        onclick="return confirm('Tem certeza que deseja excluir esta turma?');">Remover</a>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <!-- Repita o mesmo bloco para mais questionários -->
                    </div>
                </div>

                <!-- Box de cadastro de novas turmas -->
                <div class="cadastro-box" id="cadastroBox">
                    <h2>Adicionar Turma</h2>
                    <div class="rowQuest">
                    <form action="../../../controller/insertTurma.php" method="post">
                        <!-- Nome da turma -->
                        <p>Nome da Turma</p>
                        <input type="text" name="nomeTurma" placeholder="Digite o nome da Turma..."><br><br>

                        <!-- Número de alunos -->
                        <p>Numero de Alunos</p>
                        <input type="text" name="numero" placeholder="Digite a quantidade de alunos na Turma..."><br><br>

                        <!-- Seleção do professor -->
                        <p>Selecionar Professor</p>
                        <select name="codProfessor" required>
                            <option value="">Selecione o Professor</option>
                            <?php foreach ($professores as $professor): ?>
                                <option value="<?php echo $professor['codProfessor']; ?>">
                                    <?php echo htmlspecialchars($professor['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select><br><br>

                        <br/><br/><br/><br/>

                        <button class="btnList btnListVerde">Salvar</button>
                    </form>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <!-- Script para mover a primeira box -->
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

</
