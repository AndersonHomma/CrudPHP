<?php
include("config.php");

session_start();
$paginaLogin = file_get_contents($login);
$paginaMenu = file_get_contents($menuPhp);


$usuario = $_REQUEST['login'];
$email = $_REQUEST['email'];
$senhaCripto = md5($_REQUEST['senha']);
$senha = $senhaCripto;


$dadosUsuarios = [];
$nomeArq = "../" . $nomeArq;
$dadosJson = file_get_contents($nomeArq);
$dadosUsuarios = json_decode($dadosJson, true);

$autenticacao = false;


if ($usuario !== "adm@gmail.com" && $senha !== "232323") {
    
    foreach ($dadosUsuarios as $user) {

        if ($user["login"] === $usuario && $user["senha"] === $senha) {
            $autenticacao = true;
            $idUsuario = $user['id'];
            break;
        }
    }
} else { //Administrador   
    header("Location: adm.php");
}

if (isset($usuario) && !empty($usuario)) {

    if ($autenticacao) {
        $_SESSION['id'] = $idUsuario;
        header("Location: menu.php");
        exit();
    } else {
        $paginaLogin = str_replace("Digite seu login", "Dados de login não conferem", $paginaLogin);
        echo $paginaLogin;
    }
} else {
    $paginaLogin = str_replace("Digite seu login", "Dados de login não inválido", $paginaLogin);
    echo $paginaLogin;
}
