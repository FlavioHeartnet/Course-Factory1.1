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


        <div class="ui center aligned basic segment">
            <?php $cursos = all('cursos');

            while($rs = gerarArray($cursos)){
            ?>
            <div class="ui left icon action input">
                    <div class="ui toggle checkbox">
                        <input id="check" type="checkbox" name="curso[]" value="<?php echo utf8_encode($rs['Nome']) ?>">
                        <label for="check"><?php echo utf8_encode($rs['Nome']) ?></label>

                    </div>
            </div>
            <?php } ?>
            <div class="ui horizontal divider">Então </div>
            <div class="ui teal labeled icon "><input type="submit" name="result" value="Pesquisar" class="ui button green"></div>
        </div>
    </form>


    <?php if(isset($_POST['result'])) {

        $curso = $curso = $_POST['curso'];

        $texto ="";
        $count = count($curso);
        if($count > 1) {

            for ($i = 0; $i < count($curso); $i++) {
                if($i == $count-1){

                    $texto .= "'" . $curso[$i] . "'";

                }else {

                    $texto .= "'".$curso[$i]."' and";
                }
            }
            $sql = "select * from cursos where Nome = ".$texto;
            $query = buscas($sql);
            $arrayId = array();
            while($rs = gerarArray($query))
            {

                $arrayId = $rs['idCurso'];

            }


            $texto1 = "";
            for ($i = 0; $i < count($arrayId); $i++) {
                if($i == $count-1){

                    $texto1 .= "'" . $arrayId[$i] . "'";

                }else {

                    $texto1 .= "'".$arrayId[$i]."' and";
                }
            }

            $sql = "select * from modulo where idCurso = ". $texto1;

            echo $sql;
            $query = buscas($sql);

        }else{

            $texto = $curso[0];
            $sql = "select * from cursos where Nome = '$texto'";

            $query = buscas($sql);
            $rsCurso = gerarArray($query);
            $idCurso = $rsCurso['idCurso'];
            $contador = 0;
            $sql = "select * from modulo where idCurso= '$idCurso'";
            $query = buscas($sql);

        }



?>


    <!-- drag container -->

<div id="redips-drag">

    <div class="ui two column center aligned stackable grid">
    <!-- table1 -->
        <div class="column" style="max-width: 150px">
    <table border="1" class="ui red table ">

        <tbody>
        <!-- clone 2 elements + last element -->

        <tr> <td><div  class="redips-drag redips-clone ui button primary">ALG</div></td> </tr>

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
        <tr>
            <td>1Sem2015</td>
            <td>2Sem2015</td>
            <td>1Sem2016</td>
            <td>2Sem2016</td>
            <td>1Sem2017</td>
            <td>2Sem2017</td>
            <td>1Sem2018</td>
            <td>2Sem2018</td>
        </tr>


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
<div id="dialog" title="Selecione uma ação">Escolha uma ação</div>
<!-- instructions -->
        </div>

        <?php
    }
    ?>
    </div>

        </div>


</body>
</html>