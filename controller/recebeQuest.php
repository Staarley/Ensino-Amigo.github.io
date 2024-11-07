<?php

session_start();

require_once '../model/conexao.php';
//$_SESSION['id_questionario'] = $lastInsertId;

// Instanciar a classe
$conn = new Conexao();

// Recebendo os dados do formulário
$titulo = $_POST['txtTituloEnunciado'];
$enunciado = $_POST['txtEnunciado'];
echo "<script>alert($titulo);</script>";

    $lastId = $conn->insereQuestionario($titulo, $enunciado);

 
   
       // echo "<script>window.location.href = '../view/consulQuest2.php?lastId=$lastId';</script>";
       header("Location: ../view/prof/questPHP/consulQuest2.php?lastId=" . urlencode($lastId));


// Inserir no banco

// Recuperar o ID do último questionário inserido
//$lastInsertId = $conn->getLastInsertId();

// Armazenar o ID na sessão
//$_SESSION['id_questionario'] = $lastInsertId;

// Redirecionar para a próxima página

?>
