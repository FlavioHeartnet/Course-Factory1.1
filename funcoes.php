<?php

include('config.php');



function addDiciplina($nomeDiciplina, $sigla, $cargaHora, $descricao, $tipo)
{
    $nomeDiciplina = utf8_decode($nomeDiciplina);
    $sigla = utf8_decode($sigla);
    $cargaHora = utf8_decode($cargaHora);


    $sql = "INSERT INTO diciplinas(Nome, sigla, cargaHoraria, descricao, tipo)
VALUES ('$nomeDiciplina','$sigla','$cargaHora','$descricao', '$tipo')";
    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Disciplina registrada com sucesso!'); location.href='cadastro-diciplina.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao salvar!'); history.back(-1);</script>";
        return true;
    }
}

function editarDiciplina($idDiciplina,$nomeDiciplina, $sigla, $cargaHora, $descricao, $tipo)
{



    $sql = "UPDATE diciplinas SET Nome='$nomeDiciplina',sigla='$sigla',cargaHoraria='$cargaHora', descricao = '$descricao', tipo = '$tipo' WHERE idDiciplina = '$idDiciplina'";
    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Atualizado com sucesso!'); location.href='consultarDiciplina.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao Editar!'); history.back(-1);</script>";
        return true;
    }
}


function addCurso($nome, $mac, $dataMac, $modulo, $coordenador)
{
    $nome = utf8_decode($nome);

    $modulo = utf8_decode($modulo);
    $coordenador = utf8_decode($coordenador);

    $sql = "insert into cursos (Nome, codMac,dataAutoMac,Cordenador,Modulo) values('$nome', '$mac', '$dataMac', '$coordenador', '$modulo')";
    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Salvo com sucesso!'); location.href='curso.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao salvar!'); history.back(-1);</script>";
        return true;
    }


}

function editarCurso($idCurso,$nome, $mac, $dataMac, $modulo, $coordenador, $idDisciplina, $nomeDis, $sigla, $cargahoraria, $requisito, $id)
{
    $nome = utf8_decode($nome);
    $mac = utf8_decode($mac);
    $dataMac = utf8_decode($dataMac);
    $modulo = utf8_decode($modulo);
    $coordenador = utf8_decode($coordenador);

    if($nome != "") {

        for ($i = 0; $i < count($requisito); $i++) {


            $sqlDisc = "update modulo set idDiciplina = '$nomeDis[$i]', prerequisito = '$requisito[$i]' where idModulo = '$id[$i]' and idCurso = '$idCurso'";
            $sqlDisc = $GLOBALS['con']->query($sqlDisc);

            echo "<script>alert('chegou aqui')</script>";

        }

        $sql = "UPDATE cursos SET Nome='$nome',codMac='$mac',dataAutoMac='$dataMac',Cordenador='$coordenador',Modulo='$modulo' WHERE idCurso = '$idCurso'";
        $query = $GLOBALS['con']->query($sql);
        $count = count($idDisciplina);

    }else{ echo "<script>alert('O campo de disciplinas esta vazio.'); history.back(-1);</script>";
        return true;}



    if($query == true and $sqlDisc == true)
    {
        echo "<script>alert('Atualizado com sucesso!'); location.href='consultarCurso.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao editar!'); history.back(-1);</script>";
        return true;
    }


}

function deleteDiciplina($idDiciplina)
{

    $sql= "DELETE FROM diciplinas WHERE idDiciplina = '$idDiciplina'";
    $query=$GLOBALS['con']->query($sql);

    

    if($query == true)
    {
        echo "<script>alert('Deletado com sucesso!'); location.href='consultarDiciplina.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao salvar!'); history.back(-1);</script>";
        return true;
    }


}

function deleteCurso($idCurso)
{

    $sql= "DELETE FROM cursos WHERE idCurso = '$idCurso'";
    $query=$GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Deletado com sucesso!'); location.href='consultarCurso.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao salvar!'); history.back(-1);</script>";
        return true;
    }


}


function addModulo($idCurso, $semestre, $idDiciplina)
{

    $count = count($idDiciplina);

    for($i = 0;$i < $count; $i++) {

        $select = "select * from modulo where idDiciplina = '$idDiciplina[$i]' and idCurso = '$idCurso'";

        $select1 = $GLOBALS['con']->query($select);


        if($select1->num_rows<=0){

            $sql = "insert into modulo (idCurso, semestre, idDiciplina) VALUES ('$idCurso', '$semestre', '$idDiciplina[$i]')";
            $query = $GLOBALS['con']->query($sql);
        }else{

            echo "<script>alert('A disicplina ja foi adicionada!'); location.href='diciplinasCurso.php'</script>";
            return true;


        }


    }
    if($query == true)
    {
        echo "<script>alert('Diciplinas atribuidas ao modulo com sucesso!'); </script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao salvar!'); history.back(-1);</script>";
        return true;
    }

}

function deletaModulo($idCurso,$semestre)
{

    $sql = "delete from modulo where semestre = '$semestre' and idCurso = '$idCurso'";

    $query = $GLOBALS['con']->query($sql);

if($query == true)
{
    echo "<script>alert('Modulo deletado com sucesso'); location.href='home.php';</script>";
    return true;
}else
{
    echo "<script>alert('Ocorreu um erro ao deletar!'); history.back(-1);</script>";
    return true;
}

}

function deletaUsuario($idUsuario)
{

    $sql = "delete from usuariosfactory where idUsuario = '$idUsuario'";

    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Deletado com sucesso'); location.href='consultar-usuario.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao deletar!'); history.back(-1);</script>";
        return true;
    }

}

function addUsuario($nome, $usuario, $senha, $email, $status, $nivel)
{

    $sql = "INSERT INTO `usuariosfactory`(`nome`, `usuario`, `senha`, `status`, `email`, `nivel`) VALUES ('$nome','$usuario','$senha','$status','$email','$nivel')";


    $query = $GLOBALS['con']->query($sql);



    if($query == true)
    {
        echo "<script>alert('Usuario cadastrado com sucesso'); location.href='cadastro-usuario.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao cadastrar usuario!'); history.back(-1);</script>";
        return true;
    }

}
function editarUsuario($idUsuario, $nome, $usuario, $senha, $email, $status, $nivel)
{

    $sql = "UPDATE `usuariosfactory` SET `nome`='$nome',`usuario`='$usuario',`senha`='$senha',`status`='$status',`email` ='$email',`nivel`='$nivel' WHERE idUsuario = '$idUsuario'";


    $query = $GLOBALS['con']->query($sql);



    if($query == true)
    {
        echo "<script>alert('Usuario Atualizado com Sucesso'); location.href='consultar-usuario.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao Atualizar!'); history.back(-1);</script>";
        return true;
    }

}



function login($usuario, $senha, $ficarLogado){
    // Valida o usuário e senha
    $query = $GLOBALS['con']->query("SELECT * FROM usuariosFactory WHERE usuario = '$usuario' AND senha = '$senha' AND status = '1'");
    $qtd = $query->fetch_array();
    $usuario = $qtd['usuario'];
    $senha = $qtd['senha'];

    // Verifica se há usuários com a senha informada
    if($usuario == "" and $senha == ""){
        echo "<script>alert('Usuário ou senha incorretos.');</script>";
        return false;
    }else{
        // Verifica se o usuário quer guardar o login e senha em cookie
        if($ficarLogado == 1){
            setcookie("usuario", $usuario, (time() + (30 * 24 * 3600)));
            setcookie("senha", $senha, (time() + (30 * 24 * 3600)));
        };
        $sql = $GLOBALS['con']->query("SELECT * FROM usuariosFactory WHERE usuario = '$usuario'");

        $dadosUsuario = $sql->fetch_array();
        $nivel = $dadosUsuario['nivel'];
        $dadosUsuario = $dadosUsuario['nome'];


        // Cria a sessão
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nivel'] = $nivel;
        header("Location: home.php");
    };
};

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
// Caracteres de cada tipo
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';

// Variáveis internas
    $retorno = '';
    $caracteres = '';

// Agrupamos todos os caracteres que poderão ser utilizados
    $caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    if ($simbolos) $caracteres .= $simb;

// Calculamos o total de caracteres possíveis
    $len = strlen($caracteres);

    for ($n = 1; $n <= $tamanho; $n++) {
// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
        $rand = mt_rand(1, $len);
// Concatenamos um dos caracteres na variável $retorno
        $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
}
function EsqueciSenha($idUsuario, $email)
{
    $query = $GLOBALS['con']->query("select * from usuarioFactory where idUsuario = '$idUsuario'");
    if($query == true){
        $query = $query->fetch_array();
        $email = $query['email'];
        $nomeDestinatario = $query['nome'];
        $novaSenha = geraSenha();
        TrocaSenha($novaSenha, $idUsuario, $nomeDestinatario);
    }else{echo "<script>alert('Ocorreu um erro ao buscar, usuario não encontrado');  history.back(-1);</script>";}
}

function TrocaSenha($senha, $idUsuario, $nome)
{
    $query = $GLOBALS['con']->query("update usuarioFactoy set senha = '$senha' where idUsuario = '$idUsuario'");
    if($query == true)
    {


        echo "<script>alert('Senha alterada com sucesso'); location.href='index.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao tentar Trocar sua senha, tente novamente ou entre em contato com o administrador.'); history.back(-1); </script>";
        return false;
    }


}

function EditarAluno($nome, $sobrenome, $idCurso, $idTurma, $endereco, $telefone, $celular, $RA, $cpf, $RG, $bolsa, $financiado, $dataMatricula, $idAluno)
{

    $sql = "UPDATE aluno SET nome='$nome',sobrenome='$sobrenome',idCurso='$idCurso',idTurma='$idTurma',endereco='$endereco',telefone='$telefone',
celular='$celular',RA='$RA',CPF='$cpf',RG='$RG',bolsa='$bolsa',Financiado='$financiado',DataMatricula='$dataMatricula'
WHERE '$idAluno'";


    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Aluno atualizado com sucesso'); location.href='consultarTurma.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao salvar o Aluno!'); history.back(-1);</script>";
        return true;
    }

}

function deletaAluno($idAluno)
{
    $sql = "delete from aluno where idAluno = '$idAluno'";

    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Aluno deletado com sucesso'); location.href='consultarTurma.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao deletar o Aluno!'); history.back(-1);</script>";
        return true;
    }



}

function addTurma($nome, $idCurso, $status)
{

    $sql = "INSERT INTO turma( Nome, idCurso, status) VALUES ('$nome','$idCurso', '$status')";

    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Turma cadstarda com sucesso'); location.href='cadastro-turma.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao salvar ao cadastar a turma!'); history.back(-1);</script>";
        return true;
    }

}

function editarTurma($nome, $idCurso, $idTurma, $status)
{

    $sql = "UPDATE `turma` SET Nome='$nome',idCurso='$idCurso', status='$status' WHERE idTurma = '$idTurma'";

    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Turma editada com sucesso'); location.href='consultarTurma.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao editar a turma!'); history.back(-1);</script>";
        return true;
    }


}

function deletarTurma($idTurma)
{

    $sql = "DELETE FROM `turma` WHERE idTurma = '$idTurma'";

    $query = $GLOBALS['con']->query($sql);

    if($query == true)
    {
        echo "<script>alert('Turma deletada com sucesso'); location.href='consultarTurma.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao deletar a turma!'); history.back(-1);</script>";
        return true;
    }


}

function addLetivo($nome, $inicio, $termino, $anterior)
{

    $busca = $GLOBALS['con']->query("select * from periodoletivo where LetivoProximo = '$anterior'");

    if($busca->num_rows == 0)
    {

        $sql = $GLOBALS['con']->query("INSERT INTO periodoletivo(Nome, inicio, termino, LetivoProximo) VALUES ('$nome','$inicio','$termino','$anterior')");

        if ($sql == true) {
            echo "<script>alert('Cadastro feito com sucesso'); location.href='cadastro-letivo.php';</script>";
            return true;
        } else {
            echo "<script>alert('Ocorreu um erro no cadastro, verifique as informações digitadas!'); history.back(-1);</script>";
            return true;
        }
    }else{   echo "<script>alert('O periodo anterior que você escolheu já foi atribuido a outra disciplina!'); history.back(-1);</script>"; }


}
function editaLetivo($idLetivo, $nome, $inicio, $termino, $proximo)
{
    $sql = $GLOBALS['con']->query("UPDATE periodoletivo SET Nome='$nome',inicio='$inicio',termino='$termino', LetivoProximo='$proximo' WHERE idLetivo = '$idLetivo'");

    if($sql == true)
    {
        echo "<script>alert('Atualizado com sucesso'); location.href='consultar-periodo.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao atualizar'); history.back(-1);</script>";
        return true;
    }



}

function deletarLetivo($idLetivo)
{

    $buscas = "select * from periodoletivo where LetivoProximo = '$idLetivo'";
    $query = $GLOBALS['con']->query($buscas);

    if ($query->num_rows > 0) {

        while($buscas = $query->fetch_array()){

            $id = $buscas['idLetivo'];

            $sql = "update periodoletivo set LetivoProximo = '0' where idLetivo = '$id'";
            $query2 = $GLOBALS['con']->query($sql);


        }

    }

        $sql = "DELETE FROM `periodoletivo` WHERE idLetivo = '$idLetivo'";

        $query = $GLOBALS['con']->query($sql);

        if ($query == true) {
            echo "<script>alert('Periodo deletado com sucesso'); location.href='consultar-periodo.php';</script>";
            return true;
        } else {
            echo "<script>alert('Ocorreu um erro ao deletar o Periodo!'); history.back(-1);</script>";
            return true;
        }




}


function alunosDisc($idTurma, $idDiciplina, $carga, $requisito,$situacao, $conclusao, $semestre, $id)
{
    $count = count($id);
    $sql = "SELECT * FROM alunos_disciplinas where idTurma = '$idTurma'";
    $query2 = $GLOBALS['con']->query($sql);

    $arraydisc = array_unique($idDiciplina);

    if(count($arraydisc) != count($idDiciplina))
    {
        echo "<script>alert('Existem disicplinas duplicadas! corrija isso antes de salvar!'); history.back(-1);</script>";
        return false;

    }

    if($query2->num_rows<=0)
    {
        for($i = 0 ; $i < $count; $i++) {
            $sql2 = "INSERT INTO alunos_disciplinas( idDiciplina, idTurma, cargaHoraria, prerequisito, situacao, semestre,PeriodoLetivo)
 VALUES ('$idDiciplina[$i]','$idTurma','$carga[$i]','$requisito[$i]','$situacao[$i]','$semestre[$i]', '$conclusao[$i]')";
            $query = $GLOBALS['con']->query($sql2);
        }

    }else
    {
        for($i = 0 ; $i < $count; $i++)
        {
            $sql2 = "UPDATE alunos_disciplinas SET idDiciplina='$idDiciplina[$i]', PeriodoLetivo = '$conclusao[$i]', idTurma='$idTurma',cargaHoraria='$carga[$i]',
prerequisito='$requisito[$i]',situacao='$situacao[$i]', semestre='$semestre[$i]'  WHERE
idAD = '$id[$i]' and idTurma = '$idTurma'";
            $query = $GLOBALS['con']->query($sql2);
        }

    }

    if($query == true)
    {
        echo "<script>alert('Grade do aluno construida'); location.href='consultarTurma.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao atualizar'); history.back(-1);</script>";
        return false;
    }



}

function verificaRequisito($idDisciplina, $idturma)
{

    $sql = "SELECT * FROM alunos_disciplinas WHERE idDiciplina = '$idDisciplina' and idTurma= '$idturma'";
    $query = $GLOBALS['con']->query($sql);
    $rsQuery = $query->fetch_array();

    $requisito = $rsQuery['prerequisito'];

    if($requisito == 0)
    {

        return 'Permitido';

    }

    $sql = "SELECT * FROM alunos_disciplinas WHERE idDiciplina = '$requisito' and idTurma= '$idturma'";
    $query = $GLOBALS['con']->query($sql);
    $rsQuery = $query->fetch_array();

    $situacao = $rsQuery['situacao'];


    if($situacao == 1)
    {
        return "Esta disciplina está com um pre-requisito que não foi cursado";

    }else if($situacao == 2)
    {
        return "Esta disciplina está com um pre-requisito que esta sendo cursado";

    }else{

        return 'Permitido';

    }

}


function gravarGrade($semestre, $idDisciplina, $idTurma, $periodo, $idCurso, $resp)
{

    $count = count($idDisciplina);

    for($i=0; $i < $count ;$i++) {

        if ($resp == true) {


            $sql = "SELECT * FROM `alunos_disciplinas` WHERE idDiciplina = $idDisciplina[$i] and idTurma = '$idTurma' and semestre = '$semestre[$i]'";
            $query = $GLOBALS['con']->query($sql);

            if ($query->num_rows == 0) {
                $desciplinas = buscaDisciplina($idDisciplina[$i]);
                $carga = $desciplinas['cargaHoraria'];
                $requisito = buscaRequisitos($idDisciplina[$i], $idCurso);


                $sql = "INSERT INTO `alunos_disciplinas`(`idDiciplina`, `idTurma`, `cargaHoraria`, `prerequisito`, `situacao`, `PeriodoLetivo`, `semestre`) VALUES ('$idDisciplina[$i]','$idTurma',
                '$carga','$requisito',1,'$periodo','$semestre[$i]')";
                $query = $GLOBALS['con']->query($sql);

            } else {
                $sql = "update alunos_disciplinas set PeriodoLetivo = '$periodo' where  idDiciplina = '$idDisciplina[$i]' and idTurma = '$idTurma' and semestre = '$semestre[$i]' ";
                $query = $GLOBALS['con']->query($sql);


            }

        }

    }
    if($query == true)
    {
        echo "<script>alert('Salvo com sucesso'); location.href='gradeTurma.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu uma falha ao atualizar'); history.back(-1);</script>";
        return true;
    }


}

function buscaRequisitos($idDisciplina, $idCurso)
{
    $sql = "SELECT * FROM `modulo` where idDiciplina = '$idDisciplina' and idCurso = '$idCurso'";
    $query = $GLOBALS['con']->query($sql);
    $rsQuery = $query->fetch_array();

    return $rsQuery['prerequisito'];

}

function buscaDisciplina($idDisciplina)
{


    $sql = "SELECT * FROM `diciplinas` where idDiciplina = '$idDisciplina'";
    $query = $GLOBALS['con']->query($sql);
    $rsQuery = $query->fetch_array();

    $disciplinas = [

        'Nome' => utf8_encode($rsQuery['Nome']),
        'Sigla' => utf8_encode($rsQuery['sigla']),
        'cargaHoraria' => utf8_encode($rsQuery['cargaHoraria']),
        'descricao' => utf8_encode($rsQuery['descricao'])

    ];

    return $disciplinas;


}

function buscaCurso($idCurso)
{


    $sql = "SELECT * FROM `cursos` where idCurso = '$idCurso'";
    $query = buscas($sql);
    $rsQuery = gerarArray($query);

    $cursos = [

        'Nome' => utf8_encode($rsQuery['Nome']),
        'codMac' => utf8_encode($rsQuery['codMac']),
        'dataAutoMac' => utf8_encode($rsQuery['dataAutoMac']),
        'Cordenador' => utf8_encode($rsQuery['Cordenador']),
        'Modulo' => $rsQuery['Modulo']

    ];

    return $cursos;


}

function all($table)
{

    $sql = "SELECT * FROM `$table`";
    $query = buscas($sql);


    return $query;

}

function buscaTurma($idTurma)
{


    $sql = "SELECT * FROM `turma` where idTurma = '$idTurma'";
    $query = $GLOBALS['con']->query($sql);
    $rsQuery = $query->fetch_array();

    $turmas = [

        'Nome' => utf8_encode($rsQuery['Nome']),
        'idCurso' => $rsQuery['idCurso'],
        'status' => $rsQuery['status']

    ];

    return $turmas;


}

function historicoletivo($semestre, $numAlunos, $idCurso,$idTurma, $idLetivo)
{


    for($i = 0; $i< $semestre;$i++)
    {
        $let = $i +1;

        if($numAlunos[$i] != "")
        {

            $sql3 = "SELECT * FROM historicoletivo where idTurma= '$idTurma' and semestre = '$let'";
            $historico = $GLOBALS['con']->query($sql3);
            if($historico->num_rows<=0) {

                $sql = "INSERT INTO historicoletivo(idLetivo, idTurma, numAlunos, idCurso, semestre) VALUES ('$idLetivo[$i]','$idTurma','$numAlunos[$i]','$idCurso','$let')";
                $query = $GLOBALS['con']->query($sql);
            }else
            {

                $sql = "UPDATE historicoletivo SET idLetivo='$idLetivo[$i]',numAlunos='$numAlunos[$i]' WHERE idTurma='$idTurma' and semestre = '$let'";
                $query = $GLOBALS['con']->query($sql);

            }


        }
    }

    if($query == true)
    {
        echo "<script>alert('Salvo com sucesso'); location.href='consultarTurma.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu uma falha ao atualizar'); history.back(-1);</script>";
        return true;
    }



}

function iserirEquivalente($idDisciplina, $equivalente, $requisito)
{

    $count = count($equivalente);

    for($i =0;$i< $count;$i++)
    {

        $sql = $GLOBALS['con']->query("insert into disciplinas_equivalentes (idDisciplina, disciplinaEq,prerequisito) values('$idDisciplina','$equivalente[$i]','$requisito]')");


    }

    if($sql == true)
    {
        echo "<script>alert('Disciplinas equivalentes inseridas'); location.href='disciplinas-equivalentes.php';</script>";
        return true;
    }else
    {
        echo "<script>alert('Ocorreu um erro ao inserir'); history.back(-1);</script>";
        return true;
    }



}

function gradeLetica($ad, $letivo)
{

    $sql = "update alunos_historico set PeriodoLertivo='$letivo' where idAD = '$ad'";



}


function buscas($sql)
{


    $query = $GLOBALS['con']->query($sql);

    return $query;

}

function gerarArray($sql)
{


    return $sql->fetch_array();

}

