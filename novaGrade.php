<?php
include("topo.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta name="author" content="Darko Bunic"/>
    <meta name="description" content="Drag and drop table content with JavaScript"/>
    <meta name="viewport" content="width=device-width, user-scalable=no"/><!-- "position: fixed" fix for Android 2.2+ -->


    <link rel="stylesheet" href="css/semantic.css"/>
    <script type="text/javascript" src="js/redips-drag-min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <!-- load jQuery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/semantic.js"></script>

    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css"/>

    <title>Pagina da Grade</title>
</head>
<body id="home">
<div class="ui horizontal feature segment">

    <div class="ui center page grid">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="ui fluid category search ">
            <div class="ui icon input">
                <input class="prompt" autocomplete="off" required="" name="curso" id="" type="text" placeholder="Proucurar curso">

                <i class="search icon buscarM"></i>
            </div>
            <div class="results"></div>
        </div>
        <br>
        <span>Selecione o modulo</span>
        <div class="column">
            <label>
                <select required="" class="ui dropdown" name="modulo">
                    <?php $sql2 = $con->query("select * from periodoletivo where 1");

                    while($quey3 = $sql2->fetch_array()){
                        ?>
                        <option value="<?php echo $quey3['idLetivo']; ?>"><?php echo $quey3['Nome']; ?></option>

                    <?php } ?>
                </select>
            </label>

            <input type="submit" name="result" value="Selecionar" class="ui green right labeled icon button">

        </div>
    </form>


    <?php if(isset($_POST['result'])) {

        $curso = utf8_decode($curso = $_POST['curso']);
        $modulo = $_POST['modulo'];


        $sql = "select * from cursos where Nome= '$curso'";
        $query = $con->query($sql);
        $rsCurso = $query->fetch_array();
        $idCurso = $rsCurso['idCurso'];
        $contador = 0;


        $sql = "select * from modulo where idCurso= '$idCurso'";
        $query = $con->query($sql);

    }
    ?>
    </div>
    <!-- drag container -->

<div id="redips-drag">

    <div class="ui two column center aligned stackable grid">
    <!-- table1 -->
        <div class="column" style="max-width: 150px">
    <table border="1" class="ui red table ">

        <tbody>
        <!-- clone 2 elements + last element -->

        <tr> <td><div  class="redips-drag redips-clone ui button primary"><div class="">ALG</div>
                    <div class="ui fluid popup top left transition hidden">
                        <div class="ui four column divided center aligned grid">
                            <div class="column">Algorimos</div>
                            <div class="column">Ciencias da computação</div>
                            <div class="column">40 horas </div>

                        </div>
                    </div></div></td> </tr>
        <tr> <td><div  class="redips-drag redips-clone ui button primary">Mat</div></td></tr>
        <tr><td><div  class="redips-drag redips-clone ui button primary">BD1</div></td></tr>
        <tr> <td><div  class="redips-drag redips-clone ui button primary">BD2</div></td></tr>
        <tr> <td><div  class="redips-drag redips-clone ui button primary">Alg2</div></td></tr>
        <tr> <td><div  class="redips-drag redips-clone ui button primary">ENG</div></td></tr>
        <tr> <td class="redips-trash">Deletar</td>

        </tbody>
    </table>
        </div>

        <div class="column">
            <div class="ui left Modulos">Turma 1</div>
    <!-- table2 -->
    <table border="1" class="ui red table bordered">
        <colgroup>
            <col width="100"/>
            <col width="100"/>
            <col width="100"/>
            <col width="100"/>
        </colgroup>
        <tbody>
        <tr ><td>1Sem2015</td>
            <td>2Sem2015</td>
            <td>1Sem2016</td>
            <td>2Sem2016</td>
            <td>1Sem2017</td>
            <td>2Sem2017</td>
            <td>1Sem2018</td>
            <td>2Sem2018</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>


        </tbody>
    </table>
            </div>
</div>
<!-- jQuery dialog -->
<div id="dialog" title="jQuery dialog">Escolha uma ação</div>
<!-- instructions -->
        </div>
        </div>


</body>
</html>