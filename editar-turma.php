<?php
include("topo.php");


if(isset($_POST['gravar']))
{
    $nome = $_POST['nome'];
    $idCurso = $_POST['curso'];
    $idTurma = $_POST['idTurma'];
    $status = $_POST['status'];

    editarTurma($nome, $idCurso, $idTurma, $status);

}elseif(isset($_POST['deletar']))
{

    $idTurma = $_POST['idTurma'];
    deletarTurma($idTurma);

}

if(isset($_POST['idTurma']))
{

    $idTurma = $_POST['idTurma'];
    $sql = "select * from turma where idTurma = '$idTurma'";
    $query = $GLOBALS['con']->query($sql);

}else{

    echo "<script>alert('Você acessou a pagina de forma incorreta, você será redirecionado!'); location.href='home.php'</script>";
    //header("Location: home.php");

}

?>
<html>
<body id="home">

<?php

while($buscaTurma = $query->fetch_array()){

    $idTurma = $buscaTurma['idTurma'];
?>
<div class="ui vertical feature segment">
    <div class="ui centered page grid">
        <div class="titlePage">
            Editar turmas
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="fourteen wide column">
                <div class="ui two column center aligned stackable divided grid">

                    <div class="cadastroDisciplina column">
                        <p class="cadastroLabel">Nome da Turma</p>
                        <input type="hidden" name="idTurma" value="<?php echo $idTurma ?>">
                        <input class="inputDisciplina" name="nome" type="text" value="<?php echo $buscaTurma['Nome'] ?>" placeholder="Nome da Turma">
                        <br><br>

                        <div class="cadastroDisciplina column">
                            <div class="cadastroDisciplina column">
                                <p class="cadastroLabel">Curso</p>
                                <label>
                                    <div style="text-align: left">
                                        <select class="ui dropdown" name="curso" style="width: 100%	">

                                            <?php   $curso = $buscaTurma['idCurso'];
                                            $query = $con->query("select * from cursos where idCurso = '$curso'");

                                            $rsQuery = $query->fetch_array();
                                            ?>

                                            <option value="<?php echo $buscaTurma['idCurso'] ?>"><?php echo $rsQuery['Nome'] ?></option>
                                            <i class="dropdown icon"></i>
                                            <?php


                                            $query = $con->query("select * from cursos");
                                            while($rsQuery = $query->fetch_array()){
                                                ?>
                                                <option value="<?php echo $rsQuery['idCurso']; ?>"><?php echo utf8_encode($rsQuery['Nome']); ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </label>
                            </div>

                        </div>

                        <br>

                        <div class="cadastroDisciplina column">
                            <p class="cadastroLabel">Status desta turma</p>

                            <div style="text-align: left">
                                <label for="status">
                                    <select id="status" class="ui dropdown" required="" name="status" style="width: 100%	">

                                        <?php

                                        $query = $con->query("select * from turma where idTurma = '$idTurma'");
                                        $turmas= $query->fetch_array();

                                        $status = $turmas['status'];


                                        switch($status){

                                            case 1: $texto = 'Ativo';
                                                break;
                                            case 0: $texto = 'Inativo';
                                                break;
                                            default: $texto = 'Valor incorreto';
                                                break;

                                        }
                                        ?>
                                        <option value="<?php echo $turmas['status']?>"><?php echo $texto ?></option>

                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>

                                    </select>
                                </label>
                            </div>

                        </div>


                    </div>

                </div>

                <br>
                <div class="cadastroDisciplina column ">


                    <input type="submit" name="gravar" class="ui green right labeled icon button" value="Atualizar">

                    <i class="right chevron icon"></i>
                    <input type="submit" name="deletar" class="ui red right labeled icon button" value="Deletar">

                </div>

            </div>
        </form>
    </div>
</div>

<?php } ?>


<?php



?>
</body>
</html>
