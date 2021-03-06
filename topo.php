<?php

include("funcoes.php");
session_start();
if($_SESSION['usuario'] == ""){ header("Location: index.php"); };
$usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM usuariosfactory where usuario = '$usuario'";
$query = $con->query($sql);
$rsQuery = $query->fetch_array();
$idUsuario = $rsQuery['idUsuario'];
$nivel = $rsQuery['nivel'];


?>
<head>
    <title> Course Factory SYS - Admin </title>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Semantic-UI-1.10.4/dist/semantic.css">
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">


    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

    <script src="js/semantic.js"></script>
    <script src="js/homepage.js"></script>


</head>
<div class="ui navbar inverted">
    <div  class="ui centered page grid">
        <br>
        <img class="ui medium image" src="img/logotipo.png" style="margin-top: 25px;">
    </div>
</div>

<div class="ui page grid2">
    <div class="column">
        <div class="ui inverted menu dash">
            <div class="header item">Course Factory SYS</div>
            <div class="right menu">
                <div class="ui mobile dropdown link item">
                    Menu
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="home.php">Home</a>
                        <a class="item" href="gradeTurma.php">Grade Turma</a>
                        <a class="item" href="cadastro-diciplina.php">Cadastro de disciplina</a>
                        <a class="item" href="consultarDiciplina.php">Consulta de disciplina</a>
                        <a class="item" href="curso.php">Cadastro de curso</a>
                        <a class="item" href="consultarCurso.php">Consulta de curso</a>
                        <a class="item" href="diciplinasCurso.php">Atribuir diciplinas ao curso</a>
                        <a class="item" href="consultarTurma.php">Consulta de turmas</a>
                        <?php if($nivel == 1){
                        ?>
                        <a class="item" href="consultarTurma.php">Disciplinas da turma</a>
                        <?php } ?>
                        <a class="item" href="cadastro-turma.php">Cadastro de Turmas</a>
                        <a class="item" href="cadastro-letivo.php">Cadastro de Periodo Letivo</a>
                        <a class="item" href="cadastro-usuario.php">Cadastro de Usuários</a>
                        <a class="item" href="consultar-usuario.php">Consultar Usuários</a>


                    </div>
                </div>
                <div class="ui dropdown link item">
                    Disciplina
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="cadastro-diciplina.php">Cadastro</a>
                        <a class="item" href="consultarDiciplina.php">Consulta</a>

                    </div>
                </div>
                <div class="ui dropdown link item">
                    Curso
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="curso.php">Cadastro</a>
                        <a class="item" href="consultarCurso.php">Consulta</a>
                        <a class="item" href="diciplinasCurso.php">Atribuir diciplinas ao curso</a>
                    </div>
                </div>

               <!-- <div class="ui dropdown link item">
                    Alunos
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="cadastroAluno.php">Cadastro</a>
                        <a class="item" href="consultarAluno.php">Consulta</a>

                    </div>
                </div> -->
                <div class="ui dropdown link item">
                    Gerenciamento de Turmas
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <?php if($nivel == 1){
                        ?>
                        <a class="item" href="consultarTurma.php">Disciplinas da Turma</a>
                        <?php } ?>
                        <a class="item" href="cadastro-turma.php">Cadastro de Turmas</a>
                        <a class="item" href="cadastro-letivo.php">Cadastro de Periodo Letivo</a>
                        <a class="item" href="consultar-periodo.php">Consultar Periodo Letivo</a>

                    </div>
                </div>
                <?php if($nivel == 1){
                    ?>
                <div class="ui dropdown link item">
                    Gerenciamento de Usuarios
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="cadastro-usuario.php">Cadastro de Usuários</a>
                        <a class="item" href="consultar-usuario.php">Consultar Usuários</a>



                    </div>
                </div>
                <?php } ?>
                <a class="item" href="index.php">Sair</a>
            </div>
        </div>
    </div>
</div>