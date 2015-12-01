<?php
include("topo.php");


if($nivel == 0){ echo "<script>alert('Você não tem permissão para acessar esta pagina!'); location.href='home.php'</script>"; }

if(isset($_POST['idUsuario']))
{

    $idUsuario = $_POST['idUsuario'];
    $sql = "select * from usuariosfactory where idUsuario = '$idUsuario'";
    $query = $GLOBALS['con']->query($sql);

}else{

    echo "<script>alert('Você acessou a pagina de forma incorreta, você será redirecionado!'); location.href='home.php'</script>";


}

if(isset($_POST['gravar']))
{
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $idUsuario = $_POST['idUsuario'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $nivel = $_POST['nivel'];


    editarUsuario($idUsuario, $nome, $usuario, $senha, $email, $status, $nivel);

}elseif(isset($_POST['deletar']))
{

    $idUsuario = $_POST['idUsuario'];
    deletaUsuario($idUsuario);

}

?>
<html>
<body id="home">

<?php

while($buscasL = $query->fetch_array()){

    $idUsuario = $buscasL['idUsuario'];
    ?>

    <div class="ui vertical feature segment">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="ui centered page grid">
            <div class="titlePage">
                Editar Usuários
            </div>

                <div class="sixteen wide column">
                    <div class="ui one column center aligned stackable divided grid">
                        <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
                        <div class="cadastroDisciplina column">
                            <p class="cadastroLabel">Nome</p>
                            <input class="inputDisciplina" name="nome" value="<?php echo $buscasL['nome'] ?>" type="text" placeholder="Nome">
                            <br><br>
                            <p class="cadastroLabel">Usuário</p>
                            <input class="inputDisciplina" name="usuario" value="<?php echo $buscasL['usuario'] ?>" type="text" placeholder="Usuário">
                            <br><br>
                            <p class="cadastroLabel">Senha</p>
                            <input class="inputDisciplina" name="senha" value="<?php echo $buscasL['senha'] ?>" type="password" placeholder="Senha">
                            <br><br>
                            <p class="cadastroLabel">Email</p>
                            <input class="inputDisciplina" name="email" value="<?php echo $buscasL['email'] ?>" type="email" placeholder="Email">
                            <br><br>
                            <p class="cadastroLabel">Status</p>
                            <select required="" class="ui dropdown" name="status">

                                <?php $sqls = $con->query("select * from usuariosfactory where idUsuario = '$idUsuario'");
                                while($quey3 = $sqls->fetch_array()){
                                    $status = $quey3['status'];

                                    ?>

                                    <option value="<?php echo $status; ?>"><?php switch($status)
                                        {

                                            case 1: $texto = 'Ativo';
                                                break;
                                            case 0: $texto = 'Inativo';
                                                break;
                                            default: $texto = 'Valor incorreto';

                                        }
                                        echo $texto
                                        ?></option>
                                <?php } ?>

                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>

                            </select>
                            <br><br>
                            <p class="cadastroLabel">Nível</p>
                            <select required="" class="ui dropdown" name="nivel">

                                <?php $sqls = $con->query("select * from usuariosfactory where idUsuario = '$idUsuario'");
                                while($quey3 = $sqls->fetch_array()){
                                    $nivel = $quey3['nivel'];

                                    ?>

                                    <option value="<?php echo $nivel; ?>"><?php switch($nivel)
                                        {

                                            case 1: $texto = 'Admistrativo';
                                                break;
                                            case 0: $texto = 'Usuário';
                                                break;
                                            default: $texto = 'Valor incorreto';

                                        }
                                        echo $texto
                                        ?></option>
                                <?php } ?>

                                <option value="1">Admistrativo</option>
                                <option value="0">Usuário</option>

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


        </div>
        </form>
    </div>


<?php } ?>


<?php



?>
</body>
</html>
