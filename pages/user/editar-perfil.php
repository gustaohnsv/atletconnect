<?php

    include_once('./config.php');
    session_start();

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: homepage.php');
    }
    
    $logado = $_SESSION['email'];

    $sql = "select * from atletconnect.tbaluno where email = '$logado'";
    $result = $conexao->query($sql);

    if(isset($_POST['salvar-perfil'])) {

        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $celular = $_POST['telefone'];

        $sqlSalvar = "update atletconnect.tbaluno set senha = '$senha', celular = '$celular' where email = '$logado'";
        $resultSalvar = $conexao->query($sqlSalvar);
        header("Location: perfil.php");
    }

    if(isset($_FILES['arquivo'])) {

        $sql_query = $conexao->query("select * from atletconnect.tbaluno where email = 'logado'") or die($mysqli->error);
        $arquivo = $sql_query->fetch_assoc();

        $arquivo = $_FILES['arquivo'];

        if($arquivo['error'])
            die("Falha ao enviar o arquivo");

        if($arquivo['size'] > 10485760)
            die("Arquivo muito grade. O tamanho do arquivo não deve ultrapassar 10Mb");
        
            $pasta = "../../images/user-images/";
            $nomeArquivo = $arquivo['name'];
            $novoNomeArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

            if($extensao != "jpg" && $extensao != 'png')
                die("Tipo de arquivo não aceito");

            $path = $pasta . $novoNomeArquivo . "." . $extensao;

            $foto = $sql_query->fetch_assoc();

        //if (is_file($foto['path'])) {

            //$sql_query = $conexao->query("select nomefoto, path from atletconnect.tbalunos where email = '$logado'");
            //$arquivo = $sql_query->fetch_assoc();
            //unlink($arquivo['path']);
            //echo "<script> alert('Deu ruim') </script>";

        //}


        //else {

            $upload = move_uploaded_file($arquivo["tmp_name"], $path);

            if($upload) {
                    $conexao->query("update atletconnect.tbaluno set nomefoto = '$nomeArquivo', path = '$path' where email = '$logado'") or die($conexao->error);
                    header("Location: perfil.php");
                    //echo "<p> Arquivo enviado com sucesso! <a target=\"_blank'\" href=\"../../images/user-images/$novoNomeArquivo.$extensao\"> Clique aqui </a></p>";
            } else {
                    echo "<p>Falha ao enviar arquivo</p>";
            }

        //}
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/style-perfil.css" type="text/css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="shortcut icon" href="../../images/logo-azul.png" type="image/x-icon">
    
    <title>AtletConnect</title>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<?php while($info = mysqli_fetch_assoc($result)) { ?>
    <header>
        <div class="cabecalho">
            <div class="cabecalho-logo">
                <img src="../../images/logo-azul.png" alt="Logo" class="cabecalho-logo" style="width: 50px;" id="cabecalho-logo"> 
                <span class="cabecalho-texto"> AtletConnect. </span>
            </div>
            <ul  style="list-style: none">
                <li>
                    <a href="./modalidade.php" class="cabecalho-itens"> Modalidades </a>
                </li>
                <!--
                <li>
                    <a href="./homepage.php" class="cabecalho-itens"> Home </a>
                </li>
                -->
                <li>
                    <a href="./perfil.php" class="cabecalho-itens" style="font-weight: 600;"> Meu Perfil </a>
                </li>
                <img src="<?php if ($info['path'] == false) { echo "../../images/icone-perfil.svg"; } else {echo $info['path']; } ?>" alt="Foto de perfil" class="cabecalho-icone-perfil">
            </ul>
        </div>
    </header>
    <content>
        <div class="conteudo">
        <div class="minhas-equipes">
            <span class="minhas-equipes-titulo"> Minhas Equipes </span>

            <?php   

                $id = $info['idAluno'];

                $sqlEqp = "select * from atletconnect.tbateqp where idAluno = $id";
                $resultEqp = $conexao->query($sqlEqp);
                //print_r($resultEqp);

                if (mysqli_num_rows($resultEqp) >= 1) {

                    while($modalidade = mysqli_fetch_assoc($resultEqp)) {

                        if($modalidade['idEquipe'] == 1) {
                        echo '<input type="submit" value="Vôlei masculino" class="minhas-equipes-botao" name="voleimasc" id="voleimasc">';
                        }

                        if($modalidade['idEquipe'] == 2){
                        echo '<input type="submit" value="Vôlei feminino" class="minhas-equipes-botao" name="voleifem" id="voleifem">';
                        }
                        
                        if($modalidade['idEquipe'] == 3) {
                        echo '<input type="submit" value="Futsal masculino" class="minhas-equipes-botao" name="futmasc" id="futmasc">';
                        }

                        if($modalidade['idEquipe'] == 4){
                        echo '<input type="submit" value="Futsal feminino" class="minhas-equipes-botao" name="futfem" id="futfem">';
                        }

                        if($modalidade['idEquipe'] == 5) {
                        echo '<input type="submit" value="Basquete masculino" class="minhas-equipes-botao" name="basqmasc" id="basqmasc">';
                        }
    
                        if($modalidade['idEquipe'] == 6){
                        echo '<input type="submit" value="Basquete feminino" class="minhas-equipes-botao" name="basqfem" id="basqfem">';
                        }

                    }   
                    
                }

                else  {
                    echo '<span class="minhas-equipes-novo"> Por enquanto você não esta inscrito em nenhuma equipe, porque não experimenta entrar em uma? </span>';
                }

            ?>

            <!--
            <input type="button" value="Xadrez*" class="minhas-equipes-botao">
            <input type="button" value="Cabo de guerra*" class="minhas-equipes-botao"> 
            -->
            <a href="./modalidade.php" class="minhas-equipes-botao"> + </a>
        </div>                
            <div class="perfil">
            
                <div class="perfil-cabecalho">
                    <div class="perfil-span">
                        <img src="<?php if ($info['path'] == false) { echo "../../images/icone-perfil.svg"; } else {echo $info['path']; } ?>" alt="Sua foto de perfil" class="perfil-cabecalho-foto">
                        <span class="perfil-cabecalho-titutlo-1"> Bem vindo(a), </span> 
                        <span class="perfil-cabecalho-titutlo-2"> <?php echo $info['nome'] ?> </span>
                    </div>
                    <form action="./editar-perfil.php" method="post">
                        <input type="submit" name="salvar-perfil" id="salvar-perfil" value="Salvar perfil" class="perfil-cabecalho-botao">
                    </div>
                    <div class="perfil-conteudo">
                        <!--
                        <label class="perfil-conteudo-texto"> Email: </label>
                        <input type="email" value="<?php echo $info['email'] ?>" name="email" id="email">
                        -->
                        <label class="perfil-conteudo-texto"> Senha: </label>
                        <input type="text" value="<?php echo $info['senha'] ?>" name="senha" id="senha">
                        <label class="perfil-conteudo-texto"> Telefone: </label>
                        <input type="tel" name="telefone" value="<?php echo $info['celular'] ?>" id="telefone" class="celular-edit">
                    </form>

                    <div class="perfil-rodape-botao-foto">
                        <form method="post" enctype="multipart/form-data" action="./editar-perfil.php">
                            <input type="file" name="arquivo" value="Selecionar foto de perfil" style="float: left;">
                            <input type="submit" value="Salvar foto de perfil" style="float: right;">
                        </form>
                    </div>
                </div>
                    
                <?php } ?>
                    <div class="perfil-rodape">
                        <a href="./sairLogin.php"> <input type="button" value="Sair da minha conta" style="float: left;"> </a>
                        <a href="./perfil.php"> <input type="button" value="Voltar" style="float: right;"> </a>
                    </div>
            </div>
        </div>
    </content>
    <script src="../../js/input-masks.js"></script>
    <script>

        $('#voleimasc').click(function(){

        toastr.success("Você esta inscrito nessa equipe!", "Vôlei Masculino")
        })

        $('#voleifem').click(function(){

        toastr.success("Você esta inscrito nessa equipe!", "Vôlei Feminino")
        })

        $('#futmasc').click(function(){

        toastr.success("Você esta inscrito nessa equipe!", "Futsal Masculino")
        })

        $('#futfem').click(function(){

        toastr.success("Você esta inscrito nessa equipe!", "Futsal Feminino")
        })

        $('#basqmasc').click(function(){

        toastr.success("Você esta inscrito nessa equipe!", "Basquete Masculino")
        })

        $('#basqfem').click(function(){

        toastr.success("Você esta inscrito nessa equipe!", "Basquete Feminino")
        })

        toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

</script>
</body>
</html>