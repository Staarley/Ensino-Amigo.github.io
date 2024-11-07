<?php
include("../../../controller/recebeSelectTurma.php");
require_once '../../../model/conexao.php';

$db = new conexao();
$alunos = $db->getAlunos();

// Inicializando variáveis
$nome = '';
$dataNascimento = '';
$grauTEA = '';
$turma = '';
$ra = '';

// Verifica se os parâmetros estão na URL
if (isset($_GET['id'])) {
    $ra = htmlspecialchars($_GET['id']);
    $nome = htmlspecialchars($_GET['nome']);
    $dataNascimento = htmlspecialchars($_GET['dataNascimento']);
    $grauTEA = htmlspecialchars($_GET['grauTEA']);
    $turma = htmlspecialchars($_GET['turma']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/consultas.css">
    <title>Consulta Alunos | Ensino Amigo</title>
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
                    <a href="../inicioSec.php">
                        <button class="btnInicio btnNav">Início</button>
                    </a>
                </div>

                <div class="dropdown">
                    <button class="btnCadastro btnNav">Cadastro</button>
                    <div class="dropdown-content cadastro-dropdown">
                        <a href="../profPHP/consulProf.php">Professores</a>
                        <a href="#">Alunos</a>
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

            <!-- Modal -->
    <div id="modal" class="modal-overlay">
        <div class="modal-content">
            <span onclick="closeModal()" class="close-btn">&times;</span>
            <form action="editar.php" method="post" class="form">
                <!-- Campo oculto para armazenar o código do aluno -->
                <input type="hidden" name="codAluno" id="edit_codAluno">

                <label>Nome:</label>
                <input type="text" name="nome" id="edit_nome_display" required>

                <label>Data de Nascimento:</label>
                <input type="date" name="dataNascimento" id="edit_dataNascimento" required>

                <label>Grau de TEA:</label>
                <input type="text" name="grauTEA" id="edit_grauTEA" required>

                <label>Turma:</label>
                <input type="text" name="turma" id="edit_codTurma" required>

                <button type="submit" class="btn">Salvar</button>
            </form>
        </div>
    </div>


    <div class="distance">
            <div class="box" id="mainBox">
                <h2>Consulta Alunos</h2>
                <button class="btnNav btnAzul" onclick="moveBox()">Cadastrar Aluno</button>
                <br/><br/>
                <span>Alunos Cadastrados</span>
                <div class="consul-list">
                    <?php foreach ($alunos as $aluno): ?> 
                        <div class="consu-item">
                            <b>Nome:</b> <?php echo htmlspecialchars($aluno['nome_aluno']); ?><br>
                            <b>RA:</b> <?php echo htmlspecialchars($aluno['ra']); ?><br>
                            <b>Turma:</b> <?php echo htmlspecialchars($aluno['nomeTurma']); ?><br>
                            <div class="button-group">
                                <button type="button" class="btnList btnListVermelho btnExcluir" data-id="<?php echo htmlspecialchars($aluno['ra']); ?>">Remover</button>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="cadastro-box" id="cadastroBox">
                <h2>Cadastro de Alunos:</h2>
                <div class="rowQuest">
                    <form id="alunoForm" action="../../../controller/insertAluno.php" method="post">
                        <p>Nome do Aluno</p>
                        <input type="text" placeholder="Digite o nome do Aluno..." id="nome" name="nome" value="<?php echo $nome; ?>" required><br><br>
                        
                        <p>RA</p>
                        <input type="text" id="ra" name="ra" value="<?php echo $ra; ?>" required>
                        <br/><br/>
                        
                        <p>Data de Nascimento</p>
                        <input type="date" id="dataNascimento" name="dataNascimento" value="<?php echo $dataNascimento; ?>" required>
                        <br/><br/>

                        <p>Grau TEA</p>
                        <input type="text" id="grauTEA" name="grauTEA" value="<?php echo $grauTEA; ?>" required>
                        <br/><br/>
                        
                        <p>Turma</p>
                        <select name="turma" id="turma" class="slcturma" required>
                            <option value="">Selecione a Turma</option>
                            <?php foreach ($Turmas as $turmaData): ?>
                                <?php $selected = ($turmaData['codTurma'] == $turma) ? 'selected' : ''; ?>
                                <option value="<?php echo $turmaData['codTurma']; ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($turmaData['nomeTurma']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <br/><br/>
                        <button class="btnList btnListVerde">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</section>

    <script>
        function moveBox() {
            document.getElementById('mainBox').classList.add('right');
            document.getElementById('cadastroBox').classList.add('active');
        }

        function openModal() {
            document.getElementById('modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        document.querySelectorAll('.btnExcluir').forEach(button => {
        button.addEventListener('click', function() {
        const ra = this.getAttribute('data-id');  // Obtém o 'ra' do botão
        const confirmDelete = confirm("Tem certeza que deseja excluir este aluno?");
        if (confirmDelete) {
            window.location.href = "excluiAluno.php?ra=" + ra;  // Passando o 'ra' na URL
        }
    });
});
    </script>

</body>
</html>
