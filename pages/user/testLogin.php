<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <script src="../../js/custom.js"></script>
    <script src="../../js/sweetalert2.js"></script>
</body>
</html>

<?php

    session_start();
    if(isset($_POST['botao-login'])) {

        include_once('./config.php');

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        print_r("<br>");
        print_r('Email: ' . $email);
        print_r("<br>");
        print_r('Senha: ' . $senha);

        $sqlProf = "select * from atletconnect.tbprof where email = '$email' and senha = '$senha'";
        $resultProf = $conexao->query($sqlProf);

    if(mysqli_num_rows($resultProf) < 1) {

        $sql = "select * from atletconnect.tbaluno where email = '$email' and senha = '$senha'";
        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) < 1) {
                echo "<script> msgErro(); </script>";
            }
            
            else {
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                header('Location: perfil.php');
            }

        }

    else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: ../admin/sistema.php');
    }

    }

    else {
    }

?>