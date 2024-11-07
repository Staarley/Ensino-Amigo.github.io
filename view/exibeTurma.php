<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Turmas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Importando jQuery -->
</head>
<body>
<div class="container">
    <h3>Turmas Cadastradas</h3>
    <ul id="turmasList"> <!-- Lista de turmas -->
        <?php
            require_once("../model/conexao.php"); // Inclui a classe de conexão
            $conn = new Conexao(); // Cria a instância da conexão
            $pdo = $conn->getConnection(); // Obtém a conexão

            $query = "SELECT codTurma, nomeTurma, numeroAlunos FROM turma"; // Consulta para obter as turmas
            $stmt = $pdo->prepare($query);
            $stmt->execute(); // Executa a consulta

            $turmas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtém todas as turmas em formato associativo

            foreach ($turmas as $turma) {
                // Exibe cada turma com botão para alterar e excluir
                echo "<li>Nome da Turma: " . htmlspecialchars($turma['nomeTurma']) . 
                     " - Número de Alunos: " . htmlspecialchars($turma['numeroAlunos']) . 
                     " <button class='btnAlterar' 
                        data-id='" . $turma['codTurma'] . "' 
                        data-nome='" . htmlspecialchars($turma['nomeTurma']) . "' 
                        data-numero='" . htmlspecialchars($turma['numeroAlunos']) . "'>
                            Alterar
                        </button>
                     <button class='btnExcluir' data-id='" . $turma['codTurma'] . 
                     "'>Excluir</button></li>";
            }
        ?>
    </ul>
</div>

<script>
    // Lógica para alterar turmas
    document.querySelectorAll('.btnAlterar').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id'); // Obtém o ID da turma
            const nome = this.getAttribute('data-nome'); // Obtém o nome da turma
            const numero = this.getAttribute('data-numero'); // Obtém o número de alunos

            // Redirecionar para cadTurmas.php com os parâmetros
            window.location.href = `cadTurmas.php?codTurma=${id}&nomeTurma=${encodeURIComponent(nome)}&numeroAlunos=${numero}`;
        });
    });

    // Lógica para excluir turmas
    document.querySelectorAll('.btnExcluir').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id'); // Obtém o ID da turma
            const confirmDelete = confirm("Tem certeza que deseja excluir esta turma?"); // Confirma a exclusão
            
            if (confirmDelete) {
                // Redireciona para a página de exclusão, passando o ID da turma
                window.location.href = "../controller/excluirTurma.php?id=" + id;
            }
        });
    });
</script>

</body>
</html>
