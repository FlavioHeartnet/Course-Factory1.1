<?php
include("topo.php");

if($nivel == 0){ echo "<script>alert('Você não tem permissão para acessar esta pagina!'); location.href='home.php'</script>"; }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">



<body id="home">

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="ui vertical feature segment">
    <div class="ui centered page grid">
        <div class="titlePage">
            Cadastro de Usuario no sistema
        </div>

        <div class="fourteen wide column">
            <div class="ui two column center aligned stackable divided grid">

                <div class="cadastroDisciplina column">
                    <p class="cadastroLabel">Nome</p>
                    <input class="inputDisciplina" name="nome" type="text" placeholder="Nome">
                    <br><br>
                    <p class="cadastroLabel">Usuario</p>
                    <input class="inputDisciplina" name="usuario" type="text" placeholder="Usuario">
                    <br><br>
                    <p class="cadastroLabel">Senha</p>
                    <input class="inputDisciplina" type="password" name="senha" placeholder="Senha">
                    <br><br>
                    <br>


                </div>
                <div class="cadastroDisciplina column ">


                    <p class="cadastroLabel">Email</p>
                    <input class="inputDisciplina" type="email" name="email" placeholder="Email">
                    <br><br>
                    <br>
                    <p class="cadastroLabel">Status</p>
                    <label>
                        <select name="status" class="ui dropdown">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>

                        </select>

                    </label>
                    <br><br>
                    <p class="cadastroLabel">Nivel</p>
                    <label>
                        <select name="nivel" class="ui dropdown">
                            <option value="1">Admistrativo</option>
                            <option value="0">Usuário</option>

                        </select>
                    </label>
                    <br><br>
                    <br>


                    <input type="submit" name="gravar" class="ui green right labeled icon button" value="Cadastrar">

                    <i class="right chevron icon"></i>

                </div>


            </div>


        </div>

    </div>

</div>
</form>

<?php
if(isset($_POST['gravar']))
{
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $nivel = $_POST['nivel'];

    addUsuario($nome, $usuario, $senha, $email, $status, $nivel);
}
?>

</body>
</html>