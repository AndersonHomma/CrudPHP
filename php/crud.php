<?php
include("config.php");

session_start();
$paginaCadastro = file_get_contents($cadastro);

$idUsuario = $_SESSION['id'];

$dados = lerDados($idUsuario, $nomeArq);
$login = $_REQUEST['login'];
$senha = "";


$paginaCadastro = str_replace("#email", $login, $paginaCadastro);
$paginaCadastro = str_replace("#senha", $senha, $paginaCadastro);
$paginaCadastro = str_replace("../php/cadastro.php", "../php/update.php", $paginaCadastro);
$paginaCadastro = str_replace("#id", $idUsuario, $paginaCadastro);

echo $paginaCadastro;

function lerDados($id, $nomeArq)
    {
        $nomeArq = "../" . $nomeArq;
        $dadosJson = file_get_contents($nomeArq);
        $dados = [];
        $dadosUsuarios = json_decode ($dadosJson,true);
        
        foreach($dadosUsuarios as $usuario){
            if($usuario["id"] == $id){
                $dados = $usuario;
                break;
            }
        }
        return $dados;
    }

?>