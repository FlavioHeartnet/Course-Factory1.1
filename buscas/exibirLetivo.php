<?php
include('../config.php');

$id = $_GET['id'];

$sql = $GLOBALS['con']->query("SELECT * FROM periodoletivo WHERE idLetivo =  '$id'");

while($rsSql = $sql->fetch_array())
{




    ?>

    <div class="ui  cards">
    <div class="red cardsDisc card">
        <div class="content">
            <div class="header"><?php echo utf8_encode($rsSql['Nome'])?></div>
            <div class="description">
                <p>Ao lado você pode editar este periodo letivo</p>
            </div>
        </div>
        <div class="extra content ">
                <span class="right floated">

                  <a onclick="editarAluno()" data-dismiss="alert">
                      <i class="write icon"></i>
                      Editar</a> |

                  <a onclick="DeletaAluno()" data-dismiss="alert">


                      <i class="remove icon "></i>

                      Excluir</a>


                </span>
        </div>
    </div>
    <form id="editarAluno" method="post" action="editar-periodo.php">
        <input type="hidden" value="<?php echo $id; ?>" name="idLetivo">
        <input type="hidden" value="0" name="edita">
    </form>
    <form id="deletaaluno" action="consultar-periodo.php" method="post">
        <input type="hidden" value="<?php echo $id ?>" name="idLetivo">
        <input type="hidden" value="0" name="deleta">
    </form>



<?php

}

?>