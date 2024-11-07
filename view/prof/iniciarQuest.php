<?php 
session_start();
require_once("../../model/conexao.php");
$conn = new Conexao();
$pdo = $conn->getConnection();

// Verifica se o professor está logado
if (!isset($_SESSION["codProfessor"])) {
    echo "Você não está logado.";
    exit;
}

$codProfessor = $_SESSION["codProfessor"];


// Consulta para listar questionários
$titulos = $conn->exibiQuestionario($codProfessor);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/consultaQuest.css">
    <title>Consulta de Questionários</title>
</head>
<body>
    <section>
        <!-- Navbar -->
        <nav>
            <div class="nav-content">
                <div class="button"><a href="boletim.php"><button class="btnAlunos btnNav">Alunos</button></a></div>
                <div class="button"><a href="inicioProf.php"><button class="btnInicio btnNav">Início</button></a></div>
                <div class="dropdown"><a href="questPHP/consulQuest.php"><button class="btnCadastro btnNav">Questionário</button></a></div>
                <div class="dropdown"><a href="#"><button class="btnQuest btnNav">Dê o play</button></a></div>
                <div class="dropdown"><a href="../../../login.php"><button class="btnAmarelo btnNav">Sair</button></a></div>
            </div>
        </nav>

        <!-- Conteúdo principal -->
        <main>
            
            <!-- Lista de questionários -->
            <div class="distance">
                <div class="box" id="mainBox">
                    <h2>Questionários Cadastrados</h2>
                    <div class="consul-list">
                        <?php if ($titulos && count($titulos) > 0): ?>
                            <table>
                                <tr><th>Título</th><th>Ação</th></tr>
                                <?php foreach ($titulos as $titulo): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($titulo['titulo']); ?></td>
                                        <td>
                                            <button type="button" class="btnExcluirQuest" data-id="<?php echo $titulo['codQuestionario']; ?>">Remover</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else: ?>
                            <p>Nenhum questionário encontrado.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <!-- Script para exclusão -->
    <script>
        
        document.querySelectorAll('.btnExcluirQuest').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const confirmDelete = confirm("Tem certeza que deseja excluir este questionário?");
                if (confirmDelete) {
                    window.location.href = "excluiQuestionario.php?id=" + id;
                }
            });
        });
    </script>
</body>
</html>
