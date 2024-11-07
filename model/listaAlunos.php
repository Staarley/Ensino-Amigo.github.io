<?php 
session_start();
require_once("conexao.php");
$conn = new Conexao(); 
$pdo = $conn->getConnection(); 

$query = "SELECT codAluno, nome, dataNascimento, grauTEA, codTurma FROM aluno";
$stmt = $pdo->prepare($query);
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <style>
        /* Estilos omitidos para brevidade */
    </style>
</head>
<body>
<div class="container">
    <h3>Alunos Cadastrados</h3>
    <ul>
        <?php foreach ($alunos as $aluno): ?>
            <li>
                Nome: <?php echo htmlspecialchars($aluno['nome']); ?> - 
                Data de Nascimento: <?php echo htmlspecialchars($aluno['dataNascimento']); ?> - 
                Grau de TEA: <?php echo htmlspecialchars($aluno['grauTEA']); ?> - 
                Turma: <?php echo htmlspecialchars($aluno['codTurma']); ?> 
                <button class="btnAlterar" data-id="<?php echo $aluno['codAluno']; ?>"
                        data-nome="<?php echo htmlspecialchars($aluno['nome']); ?>"
                        data-dataNascimento="<?php echo htmlspecialchars($aluno['dataNascimento']); ?>"
                        data-grauTEA="<?php echo htmlspecialchars($aluno['grauTEA']); ?>"
                        data-turma="<?php echo htmlspecialchars($aluno['codTurma']); ?>">Editar</button>
                <button class="btnExcluir" data-id="<?php echo $aluno['codAluno']; ?>">Excluir</button>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    document.querySelectorAll('.btnAlterar').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nome = this.getAttribute('data-nome');
            const dataNascimento = this.getAttribute('data-dataNascimento');
            const grauTEA = this.getAttribute('data-grauTEA');
            const codTurma = this.getAttribute('data-turma');

            // Preencher os inputs na página de cadastro
            window.location.href = "cadAluno.php?id=" + id + "&nome=" + encodeURIComponent(nome) + "&dataNascimento=" + dataNascimento + "&grauTEA=" + encodeURIComponent(grauTEA) + "&turma=" + codTurma;
        });
    });

    document.querySelectorAll('.btnExcluir').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const confirmDelete = confirm("Tem certeza que deseja excluir este aluno?");
            if (confirmDelete) {
                window.location.href = "excluiAluno.php?id=" + id;
            }
        });
    });
</script>
</body>
</html>
