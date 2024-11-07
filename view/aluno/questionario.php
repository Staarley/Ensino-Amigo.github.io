<?php
require_once("../model/conexao.php");
session_start();

if (!isset($_SESSION["codProfessor"])) {
    echo "Você não está logado.";
    exit;
}

$codProfessor = $_SESSION["codProfessor"];
$conn = new Conexao();
$titulos = $conn->exibiQuestionario($codProfessor);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionários</title>
</head>
<body>
    <h1>Questionários cadastrados</h1>

    <?php
    if ($titulos && count($titulos) > 0) {
        echo "<table>";
        echo "<tr><th>Título</th><th>Ação</th></tr>";

        foreach ($titulos as $titulo) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($titulo['titulo']) . "</td>";
            echo "<td>
                    <form action='selecionarTurma.php' method='post'>
                        <input type='hidden' name='codQuestionario' value='" . htmlspecialchars($titulo['codQuestionario']) . "' />
                        <button type='submit'>Iniciar</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum questionário encontrado.</p>";
    }
    ?>
</body>
</html>
