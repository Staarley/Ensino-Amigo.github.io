<?php
require_once '../../../model/conexao.php';

// Verifica se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conexao = new Conexao();
$Turmas = $conexao->selectTurma();
