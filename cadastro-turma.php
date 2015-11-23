<?php
include("topo.php");

?>
<!DOCTYPE html>
<html>



<body id="home">

<div class="ui vertical feature segment">
    <div class="ui centered page grid">
        <div class="titlePage">
            Cadastro de nova turma
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="ui one column center aligned stackable grid">

                <div class="cadastroDisciplina column">
                    <p class="cadastroLabel">Nome da Turma</p>
                    <input class="inputDisciplina" name="nome" type="text" id="nomeAluno" placeholder="Nome da Turma">
                    <br><br>

                    <div class="ui two column center aligned stackable  grid">
                        <div class="cadastroDisciplina column">
                            <p class="cadastroLabel">Curso</p>

                                <div style="text-align: left">
                                    <select class="ui dropdown" name="curso" style="width: 100%	">

                                        <option value="">Selecione curso</option>
                                        <i class="dropdown icon"></i>
                                        <?php

                                        $query = $con->query("select * from cursos");
                                        while($rsQuery = $query->fetch_array()){
                                            ?>
                                            <option value="<?php echo $rsQuery['idCurso']; ?>"><?php echo utf8_encode($rsQuery['Nome']); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>

                        </div>

                        <div class="cadastroDisciplina column">
                            <p class="cadastroLabel">Status desta turma</p>

                            <div style="text-align: left">
                                <select class="ui dropdown" required="" name="status" style="width: 100%	">

                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>

                                </select>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <br>
            <input type="submit" name="turma" class="ui green right labeled icon button" value="Cadastrar">


        </form>
    </div>
    </div>


    <?php

if(isset($_POST['turma']))
{
    $nome = $_POST['nome'];
    $idCurso = $_POST['curso'];
    $status = $_POST['status'];


    addTurma($nome, $idCurso, $status);
}
    ?>

</body>
</html>
