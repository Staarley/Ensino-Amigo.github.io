<?php 



include("../controller/recebeSelectTurma.php");

// Inicializando variáveis
$nome = '';
$dataNascimento = '';
$grauTEA = '';
$turma = '';
$codAluno = '';

// Verifica se os parâmetros estão na URL
if (isset($_GET['id'])) {
    $codAluno = $_GET['id'];
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
    <title>Formulário Aluno</title>
    <style>
        body {
            background-color: #1a1a1a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            color: white;
        }

        .container {
            background-color: #333;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            width: 300px;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"], input[type="date"] {
            margin-bottom: 15px;
            padding: 10px;
            width: 100%;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #222;
            color: #fff;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #FF5722;
        }

        .delete-btn:hover {
            background-color: #E64A19;
        }

        .reset-btn {
            background-color: #FFC107;
        }

        .reset-btn:hover {
            background-color: #FFB300;
        }

        .submit-btn {
            background-color: #2196F3;
        }

        .submit-btn:hover {
            background-color: #1976D2;
        }
    </style>
</head>
<body>  
<div class="container">
    <main>
        <form id="alunoForm" action="../controller/insertAluno.php" method="post">
            <input type="hidden" name="codAluno" id="codAluno" value="<?php echo $codAluno; ?>">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>
            <label for="dataNascimento">Data de Nascimento</label>
            <input type="date" id="dataNascimento" name="dataNascimento" value="<?php echo $dataNascimento; ?>" required>
            <label for="grauTEA">Grau TEA</label>
            <input type="text" id="grauTEA" name="grauTEA" value="<?php echo $grauTEA; ?>" required>
            <label for="turma">Turma</label>
            <select name="turma" id="turma" class="slcturma" required>
                <option value="">Selecione a Turma</option>
                <?php
                foreach ($Turmas as $turmaData) {
                    $selected = ($turmaData['codTurma'] == $turma) ? 'selected' : '';
                    echo "<option value=\"" . $turmaData['codTurma'] . "\" $selected>" . $turmaData['nomeTurma'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="<?php echo $codAluno ? 'Atualizar' : 'Cadastrar'; ?>" id="submitBtn">
        </form>
    </main>
</div>
</body>
</body>
</html>
