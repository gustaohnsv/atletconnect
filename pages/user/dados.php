<?php

    if(isset($_POST['botao-cadastro'])) {
        //print_r($_POST['nome']);
        //print_r(" ");
        //print_r($_POST['sobrenome']);
        //print_r("<br>");
        //print_r($_POST['celular']);
        //print_r("<br>");
        //print_r($_POST['rg']);
        //print_r("<br>");
        //print_r($_POST['email-cadastro']);
        //print_r("<br>");
        //print_r($_POST['rm']);
        //print_r("<br>");
        //print_r($_POST['senha-cadastro']);
        //print_r("<br>");
        //print_r($_POST['senha-cadastro-confirmar']);
        //print_r("<br>");
        //print_r($_POST['datanasc']);
        //print_r("<br>");
        //print_r($_POST['turno']);
        //print_r("<br>");
        //print_r($_POST['curso']);
        //print_r("<br>");
        //print_r($_POST['serie']);
        //print_r("<br>");

        include_once('./config.php');

        /*$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(empty($dados)) {
            $retorna = ['status'=> false, 'msg' => "Erro: Houve um erro na hora de cadastrar!"];
        }else{
            $retorna = ['status' => true, 'msg' => "Usuário cadastro com sucesso!"];
        }

        echo json_encode($retorna); */

        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $celular = $_POST['celular'];
        $rg = $_POST['rg'];
        $email = $_POST['email-cadastro'];
        $rm = $_POST['rm'];
        $senha = $_POST['senha-cadastro'];
        $datanasc = $_POST['datanasc'];
        $turno = $_POST['turno'];
        $curso = $_POST['curso'];
        $serie = $_POST['serie'];

        $senhaConfirmar = $_POST['senha-cadastro-confirmar'];

        if ($senha === $senhaConfirmar) {

        $result = mysqli_query($conexao, "insert into atletconnect.tbaluno (nome,sobrenome,celular,RG,email,RM,senha,datanasc,turno,curso,serie) values ('$nome', '$sobrenome', '$celular', '$rg', '$email', '$rm', '$senha', '$datanasc', '$turno', '$curso', '$serie')");
        echo "<script> alert('Cadsastro efetuado com sucesso!'); location.href=\"homepage.php\"; </script>";

        }
        else {
            echo "<script> alert('As senhas são diferentes, tente novamente!'); location.href=\"homepage.php\"; </script>";
        }
}

?>