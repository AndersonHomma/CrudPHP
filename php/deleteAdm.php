<?php

include("config.php");
$nomeArq = "../" . $nomeArq;

session_start();

$id = $_SESSION['id'];

print_r($id);
$usuarios = [];

$dadosJson = file_get_contents($nomeArq);
$dadosUsuarios = json_decode($dadosJson, true);

foreach ($dadosUsuarios as $usuario) {
    if ($usuario['id'] != $id) { 
        $usuarios[] = $usuario; 
    }
}

$usuariosJson = json_encode($usuarios);
file_put_contents($nomeArq, $usuariosJson);

header('Location: ../php/adm.php');

