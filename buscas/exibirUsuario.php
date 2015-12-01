<?php
include('../config.php');

$id = $_GET['id'];

$sql = $GLOBALS['con']->query("SELECT * FROM usuariosfactory WHERE idUsuario =  '$id'");

while($rsSql = $sql->fetch_array())
{


    $status = $rsSql['status'];
    $nivel = $rsSql['nivel'];

    ?>

    <div class="ui  cards">
    <div class="red cardsDisc card">
        <div class="content">
            <div class="header"><?php echo $rsSql['nome']?></div>
            <div class="description">
                <p>Nivel: <?php switch($nivel){

                        case 1: $texto = 'Administrativo';
                            break;
                        case 0: $texto = 'Usuário';
                            break;
                        default: $texto = 'Valor Incorreto';

                    } echo $texto ?></p>

                <p>Status: <?php switch($status){

                        case 1: $texto = 'Ativo';
                            break;
                        case 0: $texto = 'Inativo';
                            break;
                        default: $texto = 'Valor Incorreto';

                    } echo $texto ?></p>
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
    <form id="editarAluno" method="post" action="editar-usuario.php">
        <input type="hidden" value="<?php echo $id; ?>" name="idUsuario">
        <input type="hidden" value="0" name="edita">
    </form>
    <form id="deletaaluno" action="consultar-usuario.php" method="post">
        <input type="hidden" value="<?php echo $id ?>" name="idUsuario">
        <input type="hidden" value="0" name="deleta">
    </form>



<?php

}

?>