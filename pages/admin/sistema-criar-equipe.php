<?php

    include_once("../user/config.php");

    $sql = "select * from atletconnect.tbaluno where idAluno = '1'";
    $result = $conexao->query($sql);

?>
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
                    <a href="./sairSistema.php"> Sair da conta </a>
                    <a href="./sistema.php" style="margin-top: 5%;"> Voltar </a>
                </div>
                </form>
                </div>
            </div>
            <div class="sistema-tab">
                <div class="sistema-tab-criar-equipe">
                    <form action="./sistema-criar-equipe.php">
                    <label for=""> Esporte </label>
                    <input type="text" name="esporte" id="esporte">
                    <label for=""> Gênero </label>
                    <input type="text" name="genero" id="genero">
                    <label for=""> Período </label>
                    <input type="text" name="periodo" id="periodo">
                    <label for=""> Descrição </label>
                    <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>
                    </form>
                </div>
            </div>
        </div>
    </content>
</body>
</html>