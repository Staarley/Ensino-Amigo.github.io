<?php
session_start(); // Inicia a sessão para acessar variáveis de sessão
require_once("../model/conexao.php"); // Inclui a classe de conexão

$conn = new Conexao(); // Cria uma nova instância da classe Conexao

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Turmas</title>
</head>
<body>
<h3>Cadastro de Turmas</h3>
        <form id="turmaForm" action="../controller/insertTurma.php" method="post">
            <input type="hidden" id="codTurma" name="codTurma"><br/><br/> <!-- Campo oculto para o código da turma -->
            <input type="text" id="nomeTurma" name="nomeTurma" placeholder="Nome da Turma" required><br/><br/> <!-- Campo para o nome da turma -->
            <input type="number" id="numeroAlunos" name="numeroAlunos" placeholder="Número de Alunos" required><br/><br/> <!-- Campo para o número de alunos -->
            <input type="submit" id="submitBtn" value="Cadastrar"><br/><br/> <!-- Botão para submeter o formulário -->
        </form>

        <a href="exibeTurma.php"><input type="button" value="Exibir Turmas"></a> <!-- Link para exibir turmas -->

<h3>Alunos da Turma Selecionada</h3>
<ul id="alunosList"> <!-- Lista de alunos -->
    <?php
    // Lógica para buscar alunos
    if (isset($_GET['codTurma'])) {
        $codTurma = $_GET['codTurma']; // Obtém o código da turma da URL
        $alunos = $conn->getAlunosByTurma($codTurma); // Chama o método getAlunosByTurma

        // Exibe os alunos
        if (!empty($alunos)) {
            foreach ($alunos as $aluno) {
                echo "<li>" . htmlspecialchars($aluno['nome']) . 
                     " <button class='btnExcluir' data-id='" . $aluno['codAluno'] . "'>Excluir</button></li>"; // Exibe o nome do aluno e um botão para excluir
            }
        } else {
            echo "<li>Nenhum aluno cadastrado.</li>"; // Mensagem caso não haja alunos
        }
    }
    ?>
</ul>
</body>
</html>

<script>
    // Função para capturar parâmetros da URL
    function getQueryParameter(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param); // Retorna o valor do parâmetro especificado
    }

    // Preenche os inputs com os valores passados pela URL (se existirem)
    window.onload = function() {
        const codTurma = getQueryParameter('codTurma'); // Obtém o código da turma da URL
        const nomeTurma = getQueryParameter('nomeTurma'); // Obtém o nome da turma da URL
        const numeroAlunos = getQueryParameter('numeroAlunos'); // Obtém o número de alunos da URL

        // Se os parâmetros existirem, preenche os campos correspondentes
        if (codTurma && nomeTurma && numeroAlunos) {
            document.getElementById('codTurma').value = codTurma;
            document.getElementById('nomeTurma').value = nomeTurma;
            document.getElementById('numeroAlunos').value = numeroAlunos;

            // Muda o texto do botão de submit para 'Atualizar'
            document.getElementById('submitBtn').value = 'Atualizar';

            // Altera a ação do formulário para o update
            document.getElementById('turmaForm').action = '../controller/updateTurma.php';
        }
    };

    // Lógica para excluir alunos
    document.querySelectorAll('.btnExcluir').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id'); // Obtém o ID do aluno a partir do botão
            const confirmDelete = confirm("Tem certeza que deseja excluir este aluno?"); // Confirma a exclusão
            
            if (confirmDelete) {
                // Redireciona para a página de exclusão, passando o ID do aluno
                window.location.href = "../php/excluirAluno.php?id=" + id;
            }
        });
    });
</script>
