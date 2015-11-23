<?php

include('../config.php');

$nome = $_GET['valor'];


if($nome != ""){

    $sql = $GLOBALS['con']->query("SELECT * FROM periodoletivo WHERE Nome like '%".$nome."%'");

    while($rsSql = $sql->fetch_array())
    {

        echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$rsSql['idLetivo']."')\">" .utf8_encode($rsSql['Nome'])."</a><br />";

    }

}

