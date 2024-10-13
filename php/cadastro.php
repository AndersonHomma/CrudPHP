<?php

include("config.php");

$nomeArq = "../" . $nomeArq;

$paginaCadastro = file_get_contents($cadastro);
echo $paginaCadastro;

$dados = [];

if (file_exists($nomeArq)) {
    $dadosJson = file_get_contents($nomeArq);
    $dados = json_decode($dadosJson, true);
}

$id = gerarId($dados);

$dadosForm = [];

if (isset($_REQUEST['login']) && isset($_REQUEST['senha'])) {

    $dadosForm['id'] = $id;
    $dadosForm['login'] = $_REQUEST['login'];
    $dadosForm['email'] = $_REQUEST['email'];
    $senhaCripto = md5($_REQUEST['senha']);
    $dadosForm['senha'] = $senhaCripto;
} else {
    $paginaCadastro = str_replace("FAÇA SEU CADASTRO", "Dados de login não inválido", $paginaLogin);
    echo $paginaCadastro;
}

array_push($dados, $dadosForm);

$dadosJson = json_encode($dados);

file_put_contents($nomeArq, $dadosJson);

header("Location:../index.html");

function gerarId($dados)
{

    $ids = array_column($dados, 'id');

    $id = 0;
    if (count($ids) > 0) {
        $id = max($ids);
    }
    $id++;
    return $id;
}
