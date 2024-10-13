<?php
include("config.php");
$nomeArq = "../" . $nomeArq;

$id = $_REQUEST['id'];
$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

$dadosJson     = file_get_contents($nomeArq);
$dadosUsuarios = json_decode($dadosJson, true);


for ($i = 0; $i < count($dadosUsuarios); $i++) {
    if ($dadosUsuarios[$i]['id'] == $id) {
        $dadosUsuarios[$i]['login'] = $login;
        $dadosUsuarios[$i]['senha'] = $senha;
        break;
    }
}


$dadosJson = json_encode($dadosUsuarios);
file_put_contents($nomeArq, $dadosJson);
header("Location: ../php/meuCadastro.php");
?>