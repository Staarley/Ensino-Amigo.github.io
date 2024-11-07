<?php 
session_start();
require_once("../../../model/conexao.php");

$conn = new Conexao(); 
$pdo = $conn->getConnection(); 

// Verifica se o usuário está logado
if (!isset($_SESSION['codSecretaria'])) {
    die("Erro: Você não tem permissão para acessar esta página.");
}

// Consulta para obter os dados dos professores
$query = "SELECT codProfessor, nome, email FROM professores";
$stmt = $pdo->prepare($query);
$stmt->execute();
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/consultas.css">
    <title>Consulta Professores | Ensino Amigo</title>
</head>
<body>
<section>
    <!-- Linha vermelha com ícones e perfil -->
    <div class="linhaVermelha"></div>

    <!-- Elementos de arco-íris -->
    <div class="arcoIris">
        <div class="azul"></div>
        <div class="amarelo"></div>
        <div class="vermelho"></div>
    </div>

    <!-- Navbar -->
    <nav>
        <div class="nav-content">
            <div><a href="../boletim.php"><button class="btnAlunos btnNav">Alunos</button></a></div>
            <div><a href="../inicioSec.php"><button class="btnInicio btnNav">Início</button></a></div>
            <div class="dropdown">
                <button class="btnCadastro btnNav">Cadastro</button>
                <div class="dropdown-content cadastro-dropdown">
                    <a href="#">Professores</a>
                    <a href="../alunoPHP/consulAluno.php">Alunos</a>
                    <a href="../turmaPHP/consulTurma.php">Turmas</a>
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
        <!-- Modal para edição de professor -->
        <div class="modal-overlay" id="modal">
            <div class="modal-content">
                <!-- Formulário dentro do modal -->
                <form action="../../../controller/editaProfessor.php" method="post">
                    <p>Nome do Professor</p>
                    <input type="text" name="nome" id="edit_nome" placeholder="Digite o Nome" required><br><br>

                    <p>Email</p>
                    <input type="email" name="email" id="edit_email" placeholder="Digite o Email" required><br><br>

                    <p>Senha</p>
                    <input type="password" name="senha" id="edit_senha" placeholder="Digite a Senha" required><br><br>

                    <!-- Campo oculto para armazenar o código do professor -->
                    <input type="hidden" name="codProfessor" id="edit_codProfessor">
                    
                    <!-- Botões de ação no modal -->
                    <button class="btnList btnListVerde">Salvar</button>
                    <button type="button" class="btnList btnListVermelho" onclick="closeModal()">Fechar</button>
                </form>
            </div>
        </div>

        <!-- Caixa principal de consulta de professores -->
        <div class="distance">
            <div class="box" id="mainBox">
                <h2>Consulta Professores</h2>
                <button class="btnNav btnAzul" onclick="moveBox()">Adicionar Professores</button>
                <br/><br/>
                <span>Professores Cadastrados</span>

                <!-- Lista de professores cadastrados -->
                <div class="consul-list">
                    <?php foreach ($professores as $professor): ?>
                        <div class="consu-item">
                            <?php echo htmlspecialchars($professor['nome']); ?>
                            <div>
                                <button type="button" class="btnList btnListVerde" 
                                    onclick="openModal(
                                        '<?php echo $professor['codProfessor']; ?>',
                                        '<?php echo htmlspecialchars($professor['nome']); ?>',
                                        '<?php echo htmlspecialchars($professor['email']); ?>')">Alterar</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Caixa de edição de dados -->
            <div class="cadastro-box" id="cadastroBox">
                <h2>Edição de Dados</h2>
                <div class="rowQuest">
                    <form action="../../../controller/insertProfessor.php" method="post">
                        <p>Nome do Professor</p>
                        <input type="text" name="nome" placeholder="Digite seu Nome"><br><br>

                        <p>Email</p>
                        <input type="email" name="email" placeholder="Digite seu Email"><br><br>

                        <p>Senha</p>
                        <input type="password" name="senha" placeholder="Digite sua Senha"><br><br>
                        
                        <p>Confirmar Senha</p>
                        <input type="password" name="confirmaSenha" placeholder="Confirme sua Senha"><br><br>
                        <button class="btnList btnListVerde">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</section>

<!-- Script para abrir e fechar o modal -->
<script>
    function openModal(codProfessor, nome, email) {
        document.getElementById('modal').style.display = 'flex';
        document.getElementById('edit_codProfessor').value = codProfessor;
        document.getElementById('edit_nome').value = nome;
        document.getElementById('edit_email').value = email;
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }

    function moveBox() {
        document.getElementById('mainBox').classList.add('right');
        document.getElementById('cadastroBox').classList.add('active');
    }
</script>
</body>
</html>
