<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/style-sistema.css" type="text/css">
    <link rel="shortcut icon" href="../../images/logo-azul.png" type="image/x-icon">
    <title>AtletConnect</title>
</head>
<body>
<script src="../../js/input-masks.js"></script>
<?php

    include_once("../user/config.php");
    session_start();

    if((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true)) {      
        header('Location: ../user/homepage.php');
    }

    $logado = $_SESSION['email'];

    $idAluno = $_GET['id'];

    $sql = "select * from atletconnect.tbaluno where idAluno = '$idAluno'";
    $result = $conexao->query($sql);

    if(isset($_POST['salvar-perfil'])) {

        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $celular = $_POST['celular'];
        $rg = $_POST['rg'];
        $email = $_POST['email'];
        $rm = $_POST['rm'];
        $datanasc = $_POST['datanasc'];

        echo $nome, $sobrenome;

        $sqlEditar = "update atletconnect.tbaluno set nome = '$nome', sobrenome = '$sobrenome', celular = '$celular', RG = '$rg', email = '$email', RM = '$rm', datanasc = '$datanasc' where idAluno = '$idAluno'";
        $resultEditar = $conexao->query($sqlEditar);
        header("Location: ./sistema.php");
    }

?>
    <content>
        <div class="sistema">
            <div class="sistema-func">
                <div class="sistema-func-caixa">
                <form action="./sistema-modalidade.php" method="post">
                <div class="sistema-func-cabecalho" style="margin-top: 10%;">
                <img src="../../images/logo.png" alt="Logo na cor branca.">
                </div>
                <div class="sistema-func-conteudo">
                <div class="sistema-func-titulo">
                    <span> Equipes </span>
                    <hr>
                </div>
                <!-- <input type="text" name="busca" id="busca" placeholder="ID da Modalidade." title="Insira o ID da modalidade" style="margin-bottom: 5%;">
                <input type="submit" value="Buscar" style="margin-bottom: 5%;">
                -->
                <input type="submit" value="Vôlei" name="volei" id="volei" style="margin-bottom: 5%;">
                <input type="submit" value="Futsal" name="futsal" id="futsal" style="margin-bottom: 5%;">
                <input type="submit" value="Basquete" id="basquete" name="basquete" style="margin-bottom: 5%;">
                </div>
                <div class="sistema-func-rodape" style="margin-bottom: 10%;">
                    <span> Logado como: <div class="email"><?php echo $logado; ?></div> </span>
                    <br>
                    <a href="../../pages/user/sairLogin.php"> Sair da conta </a>
                    <a href="./sistema.php" style="margin-top: 5%;"> Voltar </a>
                </div>
                </form>
                </div>
            </div>
            <?php while($info_dados = mysqli_fetch_assoc($result)) { ?>
            <div class="sistema-tab">
                <div class="sistema-tab-editar">
                    <form action="./sistema-editar-perfil.php?id=<?php echo $idAluno; ?>" method="POST">
                        <div class="sistema-tab-linha">
                            <input type="text" name="nome" id="nome" value="<?php echo $info_dados['nome']; ?>" title="Nome do Aluno.">
                            <input type="text" name="sobrenome" id="sobrenome" value="<?php echo $info_dados['sobrenome']; ?>" title="Sobrenome do Aluno.">
                        </div>
                        <div class="sistema-tab-linha">
                            <input type="tel" name="celular" id="celular" value="<?php echo $info_dados['celular']; ?>" maxlength="15" title="Número de celular.">
                            <input type="varchar" name="rg" id="rg" value="<?php echo $info_dados['RG']; ?>" maxlength="12" title="Registro Geral">
                        </div>
                        <div class="sistema-tab-linha">
                            <input type="email" name="email" id="email" value="<?php echo $info_dados['email']; ?>" title="Email do Aluno.">
                            <input type="number" name="rm" id="rm" value="<?php echo $info_dados['RM']; ?>" title="Registro de Matrícula.">
                        </div>
                        <div class="sistema-tab-linha">
                            <input type="date" name="datanasc" id="datanasc" value="<?php echo $info_dados['datanasc']; ?>" title="Data de nascimento do Aluno.">
                        </div>
                        <div class="sistema-editar-salvar">
                            <input type="submit" value="Salvar perfil." name="salvar-perfil">
                        </div>
                    </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </content>
</body>
</html>