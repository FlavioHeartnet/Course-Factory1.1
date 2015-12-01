<?php
include('../config.php');

$nome = $_GET['valor'];

if($nome != "")
{

    $sql = $GLOBALS['con']->query("SELECT * FROM usuariosfactory WHERE nome like '%".$nome."%'");

    while($rsSql = $sql->fetch_array())
    {

        echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$rsSql['idUsuario']."')\">" .$rsSql['nome']."</a><br />";

    }

}

?>

