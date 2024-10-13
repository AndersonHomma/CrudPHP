<?php

include("config.php");

echo '
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styleMeuCadastro.css">
        <title>Meu cadastro</title>
    </head>     
    
    <body class="container">
        <h1>MEUS DADOS</h1>
        <hr>';

$nomeArq = "../" . $nomeArq;
$jsonLido = file_get_contents($nomeArq);
$dadosLidos = json_decode($jsonLido, true);

echo '<br>        
        <table>
            <tr>
                <th>Login</th>
                <th>Senha</th>
                <th colspan="2">Ações</th>
            </tr>';

session_start();
$idUsuario = $_SESSION['id'];
foreach ($dadosLidos as $user) {
    if ($user["id"] == $idUsuario) {
        echo '
            <tr>
                <td>' . $user["login"] . '</td>
                <td>' . $user["senha"] . '</td>
                <td> <a href= crud.php?login=' .$user["login"]. '>Alterar</a> &nbsp;
                     <a href= delete.php>Excluir</a>
                <td>
            </tr>';
    }
}
exit();
echo '
        </table>
    </body>';
