<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/style-modalidades.css" type="text/css">
    <link rel="shortcut icon" href="../../images/logo-azul.png" type="image/x-icon">
    <title>AtletConnect</title>
</head>
<body>
    <script src="../../js/custom.js"></script>
    <script src="../../js/sweetalert2.js"></script>
    <script type="text/javascript"> 

    function msgAlerta(type, title, msg) {
        swal.fire({
            icon: type,
            title: title,
            text: msg,
        })
    }

    </script>
<?php

    include_once('./config.php');
    session_start();

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) { 
            echo "<script> location.href=\"modalidade.php\"; </script>";
            unset($_SESSION['email']); 
            unset($_SESSION['senha']);
    }
    
    $logado = $_SESSION['email'];
    $mod = $_GET['mod'];

    $sql = "select * from atletconnect.tbaluno where email = '$logado'";
    $result = $conexao->query($sql);
    $info = mysqli_fetch_assoc($result);
    $idAluno = $info['idAluno'];

    if(isset($_POST['botao-escolher'])) {

        $sqlVerificarEquipe = "select * from atletconnect.tbateqp where idAluno = '$idAluno' and idEquipe = '$mod'";
        $resultVerificarEquipe = $conexao->query($sqlVerificarEquipe);

        if($resultVerificarEquipe->num_rows < 1) {

        $sqlInsert = "insert into atletconnect.tbateqp (idEquipe, idAluno) values ($mod,$idAluno)";
        $resultInsert = $conexao->query($sqlInsert);
        echo "<script> msgBotao('success','Sucesso!','Inscrição efetuada com sucesso. Para verificar volte no seu perfil!');  </script>";

        }

        else {

            echo "<script> msgErro('error', 'Erro!', 'Você não pode entrar em uma equipe que você já esteja!'); </script>";

        }

    }

    if(isset($_POST['sair-equipe'])) {
        $sqlSair = "delete from atletconnect.tbateqp where idAluno = '$idAluno' and idEquipe='$mod'";
        $resultSair = $conexao->query($sqlSair);
        echo "<script> msgSucesso('success','Sucesso!','Você saiu da equipe com sucesso.')</script>";
    }

?>
    <header>

<div class="cabecalho" style="margin-top: 2%;">
<div class="cabecalho-logo">
    <img src="../../images/logo-azul.png" alt="Logo" class="cabecalho-logo" style="width: 50px;" id="cabecalho-logo"> 
    <span class="cabecalho-texto"> AtletConnect. </span>
</div>
<ul  style="list-style: none">
    <li>
        <a href="./modalidade.php" class="cabecalho-itens"> Modalidades </a>
    </li>
    <li>
        <a href="./unidade-ensino.php" class="cabecalho-itens"> Unidades de ensino </a>
    </li>
    <li>
        <a href="./perfil.php" class="cabecalho-itens" style="font-weight: 600;"> Meu Perfil </a>
    </li>
    <img src="<?php if ($info['path'] == false) { echo "../../images/icone-perfil.svg"; } else {echo $info['path']; } ?>" alt="Foto de perfil" class="cabecalho-icone-perfil">
</ul>
</div>
    </header>
    <content>
        <?php if ($mod == '1') { ?>
        <div class="conteudo">
            <div class="conteudo-titulo-maior"> Vôlei Masculino </div>
        <div class="conteudo-texto">
            Um dos mais populares esportes não só no Brasil, mas também na escola. Se junte ao nosso time!
            </div>
        <div class="modalidade-escolha">
            <form method="post" action="./modalidade-esporte.php?mod=<?php echo $mod; ?>" class="modalidade-escolha-campo">
                <div class="modalidade-escolha-botoes" style="margin-top: 5%">
                <a href="./modalidade.php" class="modalidade-escolha-voltar"> Voltar </a>
                <input type="button" value="Horários" onClick="msgAlerta('info','Horários','Treinos de segunda a sexta, das 18:30 até as 19:30'); return true;" class="modalidade-escolha-botao">
                <input type="submit"  value="Inscrever" name="botao-escolher" class="modalidade-escolha-botao" id="botao-escolher">
                <?php 
                
                    $resultSair = "select * from atletconnect.tbateqp where idAluno = '$idAluno' and idEquipe = '1'";
                    $sqlSair = $conexao->query($resultSair);

                    if($sqlSair->num_rows > 0) { 
                    
                ?>
                <input type="submit" value="Sair da equipe" name="sair-equipe" class="modalidade-escolha-sair" id="sair-equipe">
                <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <img src="../../images/volei.svg" alt="Atleta" class="conteudo-foto" style="min-width: 600px; max-width: 600px;">
    </content>
    <?php } ?>

        <?php if ($mod == '2') { ?>
        <div class="conteudo">
            <div class="conteudo-titulo-maior"> Vôlei Feminino </div>
        <div class="conteudo-texto">
            Um dos mais populares esportes não só no Brasil, mas também na escola. Se junte ao nosso time!
            </div>
        <div class="modalidade-escolha">
            <form method="post" action="./modalidade-esporte.php?mod=<?php echo $mod; ?>" class="modalidade-escolha-campo">
                <div class="modalidade-escolha-botoes" style="margin-top: 5%">
                <a href="./modalidade.php" class="modalidade-escolha-voltar"> Voltar </a>
                <input type="button" value="Horários" onClick="msgAlerta('info','Horários','Treinos de segunda a sexta, das 18:30 até as 19:30'); return true;" class="modalidade-escolha-botao">
                <input type="submit"  value="Inscrever" name="botao-escolher" class="modalidade-escolha-botao" id="botao-escolher">
                <?php 
                
                    $resultSair = "select * from atletconnect.tbateqp where idAluno = '$idAluno' and idEquipe = '2'";
                    $sqlSair = $conexao->query($resultSair);

                    if($sqlSair->num_rows > 0) { 
                    
                ?>
                <input type="submit" value="Sair da equipe" name="sair-equipe" class="modalidade-escolha-sair" id="sair-equipe">
                <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <img src="../../images/volei.svg" alt="Atleta" class="conteudo-foto" style="min-width: 600px; max-width: 600px;">
    </content>
    <?php } ?>

        <?php if ($mod == '3') { ?>
        <div class="conteudo">
            <div class="conteudo-titulo-maior"> Futsal Masculino </div>
        <div class="conteudo-texto">
            A modalidade mais querida da escola e uma das mais  disputadas no Tecsesp! 
            </div>
        <div class="modalidade-escolha">
            <form method="post" action="./modalidade-esporte.php?mod=<?php echo $mod; ?>" class="modalidade-escolha-campo">
                <div class="modalidade-escolha-botoes" style="margin-top: 5%">
                <a href="./modalidade.php" class="modalidade-escolha-voltar"> Voltar </a>
                <input type="button" value="Horários" onClick="msgAlerta('info','Horários','Treinos de segunda a sexta, das 18:30 até as 19:30'); return true;" class="modalidade-escolha-botao">
                <input type="submit"  value="Inscrever" name="botao-escolher" class="modalidade-escolha-botao" id="botao-escolher">
                <?php 
                
                    $resultSair = "select * from atletconnect.tbateqp where idAluno = '$idAluno' and idEquipe = '3'";
                    $sqlSair = $conexao->query($resultSair);

                    if($sqlSair->num_rows > 0) { 
                    
                ?>
                <input type="submit" value="Sair da equipe" name="sair-equipe" class="modalidade-escolha-sair" id="sair-equipe">
                <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <img src="../../images/futebol.svg" alt="Atleta" class="conteudo-foto" style="min-width: 600px; max-width: 600px;">
    </content>
    <?php } ?>

        <?php if ($mod == '4') { ?>
        <div class="conteudo">
            <div class="conteudo-titulo-maior"> Futsal Feminino </div>
        <div class="conteudo-texto">
            A modalidade mais querida da escola e uma das mais  disputadas no Tecsesp! 
            </div>
        <div class="modalidade-escolha">
            <form method="post" action="./modalidade-esporte.php?mod=<?php echo $mod; ?>" class="modalidade-escolha-campo">
                <div class="modalidade-escolha-botoes" style="margin-top: 5%">
                <a href="./modalidade.php" class="modalidade-escolha-voltar"> Voltar </a>
                <input type="button" value="Horários" onClick="msgAlerta('info','Horários','Treinos de segunda a sexta, das 18:30 até as 19:30'); return true;" class="modalidade-escolha-botao">
                <input type="submit"  value="Inscrever" name="botao-escolher" class="modalidade-escolha-botao" id="botao-escolher">
                <?php 
                
                    $resultSair = "select * from atletconnect.tbateqp where idAluno = '$idAluno' and idEquipe = '4'";
                    $sqlSair = $conexao->query($resultSair);

                    if($sqlSair->num_rows > 0) { 
                    
                ?>
                <input type="submit" value="Sair da equipe" name="sair-equipe" class="modalidade-escolha-sair" id="sair-equipe">
                <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <img src="../../images/futebol.svg" alt="Atleta" class="conteudo-foto" style="min-width: 600px; max-width: 600px;">
    </content>
    <?php } ?>

        <?php if ($mod == '5') { ?>
        <div class="conteudo">
            <div class="conteudo-titulo-maior"> Basquete Masculino </div>
        <div class="conteudo-texto">
            Originário dos Estados Unidos, o Basquete tem ganhado cada vez mais espaço no Brasil, vem fazer parte da nossa equipe!
            </div>
        <div class="modalidade-escolha">
            <form method="post" action="./modalidade-esporte.php?mod=<?php echo $mod; ?>" class="modalidade-escolha-campo">
                <div class="modalidade-escolha-botoes" style="margin-top: 5%">
                <a href="./modalidade.php" class="modalidade-escolha-voltar"> Voltar </a>
                <input type="button" value="Horários" onClick="msgAlerta('info','Horários','Treinos de segunda a sexta, das 18:30 até as 19:30'); return true;" class="modalidade-escolha-botao">
                <input type="submit"  value="Inscrever" name="botao-escolher" class="modalidade-escolha-botao" id="botao-escolher">
                <?php 
                
                    $resultSair = "select * from atletconnect.tbateqp where idAluno = '$idAluno' and idEquipe = '5'";
                    $sqlSair = $conexao->query($resultSair);

                    if($sqlSair->num_rows > 0) { 
                    
                ?>
                <input type="submit" value="Sair da equipe" name="sair-equipe" class="modalidade-escolha-sair" id="sair-equipe">
                <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <img src="../../images/basquete.svg" alt="Atleta" class="conteudo-foto" style="min-width: 600px; max-width: 600px;">
    </content>
    <?php } ?>

        <?php if ($mod == '6') { ?>
        <div class="conteudo">
            <div class="conteudo-titulo-maior"> Basquete Feminino </div>
        <div class="conteudo-texto">
            Originário dos Estados Unidos, o Basquete tem ganhado cada vez mais espaço no Brasil, vem fazer parte da nossa equipe!
        </div>
        <div class="modalidade-escolha">
            <form method="post" action="./modalidade-esporte.php?mod=<?php echo $mod; ?>" class="modalidade-escolha-campo">
                <div class="modalidade-escolha-botoes" style="margin-top: 5%">
                <a href="./modalidade.php" class="modalidade-escolha-voltar"> Voltar </a>
                <input type="button" value="Horários" onClick="msgAlerta('info','Horários','Treinos de segunda a sexta, das 18:30 até as 19:30'); return true;" class="modalidade-escolha-botao">
                <input type="submit"  value="Inscrever" name="botao-escolher" class="modalidade-escolha-botao" id="botao-escolher">
                <?php 
                
                    $resultSair = "select * from atletconnect.tbateqp where idAluno = '$idAluno' and idEquipe = '6'";
                    $sqlSair = $conexao->query($resultSair);

                    if($sqlSair->num_rows > 0) { 
                    
                ?>
                <input type="submit" value="Sair da equipe" name="sair-equipe" class="modalidade-escolha-sair" id="sair-equipe">
                <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <img src="../../images/basquete.svg" alt="Atleta" class="conteudo-foto" style="min-width: 600px; max-width: 600px;">
    </content>
    <?php } ?>
</body>
</html>