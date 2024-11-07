<?php

//utilizar o arquivo da classe conexao

    require_once '../model/conexao.php';
    //include_once 'editaQuest.php';

//instanciar a classe
$conn = new conexao();


//pegando o id do questionario


$cod = $_POST['codQuestionario'];

$conn->editaQuestionario($cod);

//recebendo o valor do cadastro da pergunta para inserir os dados no banco

    

    $pergunta = $_POST['txtPergunta'];
    $numPergunta = $_POST['txtNumPergunta'];

    $codQuest = $_POST['codQuestionario'];

    $conn->inserePergunta($pergunta, $numPergunta, $codQuest);

    //var_dump ($conn);

    echo "
    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../view/prof/questPHP/consulQuest3.php'>
    
    ";








?>