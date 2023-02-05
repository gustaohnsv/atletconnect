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
    <script src="../../js/sweetalert2.js"></script>
    <script type="text/javascript">

        function msgSair(type, title, msg, title2, msg2){

            swal.fire({
                icon: type,
                title: title,
                text: msg,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar!',
                cancelButtonText: 'Cancelar!'
            }).then((result) => {
                if (result.isConfirmed) {
                swal.fire(
                    title2,
                    msg2,
                    'success'
                )
                    console.log("Sucesso");
                }  
            })
        }

    </script>
<?php

    include_once('./config.php');
    session_start();

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        header('Location: homepage.php');
    }

    $logado = $_SESSION['email'];

    $sql = "select * from atletconnect.tbaluno where email = '$logado'";
    $result = $conexao->query($sql);
    
?>
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
            <a href="./modalidade.php" class="minhas-equipes-botao""> + </a>
        </div>
        
        <div class="perfil"> 
            <div class="perfil-cabecalho">
                <div class="perfil-span">
                    <img src="<?php if ($info['path'] == false) { echo "../../images/icone-perfil.svg"; } else {echo $info['path']; } ?>" alt="Sua foto de perfil" class="perfil-cabecalho-foto">
                    <span class="perfil-cabecalho-titutlo-1"> Bem vindo(a), </span> 
                    <span class="perfil-cabecalho-titutlo-2"> <?php echo $info['nome'] ?> </span>
                </div>
                <a href="./editar-perfil.php"> <input type="button" value="Editar" class="perfil-cabecalho-botao"> </a>
            </div>
            <div class="perfil-conteudo">
                <label class="perfil-conteudo-texto"> Nome: </label>
                <input type="text" name="nome" value="<?php echo $info['nome'] . " " . $info['sobrenome']; ?>" id="nome" disabled>
                <label class="perfil-conteudo-texto"> Email: </label>
                <input type="text" name="email" value="<?php echo $info['email'] ?>" id="email" disabled>
                <label class="perfil-conteudo-texto"> Telefone: </label>
                <input type="text" name="telefone" value
                ="<?php echo $info['celular'] ?>" id="telefone" disabled>
                <label class="perfil-conteudo-texto"> Turno/Curso: </label>
                <input type="text" name="turnocurso" value="<?php echo $info['serie'] . "/" . $info['curso'] . "/" . $info['turno'] ?>" id="turnocurso" disabled>
            </div>
            <div class="perfil-rodape"> 
                <div class="perfil-rodape-botao-sair">
                    <a href="./sairLogin.php"> <input type="button" value="Sair da minha conta" style="float: left;"> </a>
                        <?php if ($info['cargo'] == 'admin') { ?>
                            <a href="../admin/sistema.php"> <input type="button" value="Acessar o sistema" style="float: right;"> </a>
                        <?php } ?>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>
    </content>

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
