<?php
include("topo.php");




if(isset($_POST['idLetivo']))
{

    $idLetivo = $_POST['idLetivo'];
    $sql = "select * from periodoletivo where idLetivo = '$idLetivo'";
    $query = $GLOBALS['con']->query($sql);

}else{

    echo "<script>alert('Você acessou a pagina de forma incorreta, você será redirecionado!'); location.href='home.php'</script>";
    //header("Location: home.php");

}

if(isset($_POST['gravar']))
{
    $nome = $_POST['nome'];
    $inicio = $_POST['inicio'];
    $termino = $_POST['fim'];
    $idLetivo = $_POST['idLetivo'];
    $anterior = $_POST['anterior'];


    editaLetivo($idLetivo, $nome, $inicio, $termino, $anterior);

}elseif(isset($_POST['deletar']))
{

    $idLetivo = $_POST['idLetivo'];
    deletarLetivo($idLetivo);

}

?>
<html>
<body id="home">

<?php

while($buscasL = $query->fetch_array()){

    $idLetivo = $buscasL['idLetivo'];
    ?>
    <div class="ui vertical feature segment">
        <div class="ui centered page grid">
            <div class="titlePage">
                Editar Periodo Letivo
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="sixteen wide column">
                    <div class="ui one column center aligned stackable divided grid">
                        <input type="hidden" name="idLetivo" value="<?php echo $idLetivo ?>">
                        <div class="cadastroDisciplina column">
                            <p class="cadastroLabel">Nome do Periodo Letivo</p>
                            <input class="inputDisciplina" name="nome" value="<?php echo $buscasL['Nome'] ?>" type="text" placeholder="Nome">
                            <br><br>
                            <p class="cadastroLabel">Inicio</p>
                            <input class="inputDisciplina" name="inicio" value="<?php echo $buscasL['inicio'] ?>" type="date" placeholder="dd/mm/aaaa">
                            <br><br>
                            <p class="cadastroLabel">Termino</p>
                            <input class="inputDisciplina" name="fim" value="<?php echo $buscasL['termino'] ?>" type="date" placeholder="dd/mm/aaaa">
                            <br><br>
                            <p class="cadastroLabel">Periodo Letivo Anterior</p>
                            <select required="" class="ui dropdown" name="anterior">

                                <?php $sqls = $con->query("select * from periodoletivo where idLetivo = '$idLetivo'");
                                while($quey3 = $sqls->fetch_array()){

                                ?>

                                    <option value="<?php echo $quey3['idLetivo']; ?>"><?php echo $quey3['Nome']; ?></option>
                                <?php } ?>
                                <option value="0">Nenhum</option>
                                <?php $sql2 = $con->query("select * from periodoletivo where 1");

                                while($quey3 = $sql2->fetch_array()){
                                    ?>
                                    <option value="<?php echo $quey3['idLetivo']; ?>"><?php echo $quey3['Nome']; ?></option>

                                <?php } ?>
                            </select>
                            <br><br>
                            <br>


                        </div>

                        <div class="cadastroDisciplina column ">


                            <input type="submit" name="gravar" class="ui green right labeled icon button" value="Atualizar">

                            <i class="right chevron icon"></i>
                            <input type="submit" name="deletar" class="ui red right labeled icon button" value="Deletar">

                        </div>



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
