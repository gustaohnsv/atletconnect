<?php

    session_start();
    if(isset($_POST['.perfil-cabecalho-botao'])) {

        include_once('./config.php');

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        print_r("<br>");
        print_r('Email: ' . $email);
        print_r("<br>");
        print_r('Senha: ' . $senha);

        $sql = "select * from atletconnect.tbaluno where email = '$email' and senha = '$senha'";
        
        $result = $conexao->query($sql);

        //print_r($result);

        if(mysqli_num_rows($result) < 1) {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: homepage.html');
        }
        else {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: editar-perfil.php');
        }
    }
    else {
        header('Location: homepage.html');
    }

?>