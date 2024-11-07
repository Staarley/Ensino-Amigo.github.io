<?php

//utilizar o arquivo da classe conexao

    require_once '../model/conexao.php';
    //include_once 'editaQuest.php';

//instanciar a classe
$conn = new conexao();


//pegando o id do questionario


//$cod = $_POST['pergunta'];

//$conn->editaQuestionario($cod);

//recebendo o valor do cadastro da pergunta para inserir os dados no banco
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alternativas = [
        isset($_POST['txtAlternativa1']) ? $_POST['txtAlternativa1'] : '',
        isset($_POST['txtAlternativa2']) ? $_POST['txtAlternativa2'] : '',
        isset($_POST['txtAlternativa3']) ? $_POST['txtAlternativa3'] : '',
        isset($_POST['txtAlternativa4']) ? $_POST['txtAlternativa4'] : '',
    ];

    // Exibe para depuração
    //var_dump($alternativas);

    $statusCorreta = $_POST['correta'] ?? null; // Obtemos o valor do radio button
    $codPergunta = $_POST['codQuestionario'] ?? null;

    // Verifique se as alternativas não estão vazias
    if (array_filter($alternativas) && $statusCorreta && $codPergunta) {
        $conn->insereAlternativa($alternativas, $statusCorreta, $codPergunta);
    } 
    else {
        echo "<script>alert('Por favor, preencha todas as alternativas e selecione uma correta.')</script>";
    }
}

echo "
    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/prof/questPHP/consulQuest.php'>
    <script type=\"text/javascript\">
        alert(\"Cadastrado com sucesso.\");
    </script>
    ";

?>