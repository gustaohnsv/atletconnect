<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../js/lib/owlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../../js/lib/owlCarousel/dist/assets/owl.theme.default.min.css">
    <link rel="shortcut icon" href="../../images/logo-azul.png" type="image/x-icon">
    <title>AtletConnect</title>
</head>
<body>
    <script src="../../js/custom.js"></script>
    <script src="../../js/sweetalert2.js"></script>
    <script>

    function acessoNegado(){
        swal.fire({
            icon: 'error',
            title: 'Acesso negado!',
            text: 'Para continuar, você deve estar conectado no site para ingressar em uma equipe.',
            showConfirmButton: false,
            timer: 2500
        })
    } 

    </script>
    <header>
<?php

    include_once('./config.php');
    session_start();

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) { ?>

<div class="cabecalho" style="margin-top: 2%;">
    <div class="cabecalho-logo">
        <img src="../../images/logo-azul.png" alt="Logo" class="cabecalho-logo" style="width: 50px;" id="cabecalho-logo"> 
        <!-- <span class="cabecalho-texto"> AtletConnect. </span> -->
    </div>
    <ul  style="list-style: none">
        <li>
            <a href="./homepage.php" class="cabecalho-itens"> Home </a>
        </li>
        <li>
            <a href="./unidade-ensino.php" class="cabecalho-itens"> Unidades de ensino </a>
        </li>
        <li>
            <a href="./homepage.php"> <input type="button" value="Cadastre-se" class="cabecalho-botao"> </a>
        </li>
    </ul>
</div>

<?php } else {

$logado = $_SESSION['email'];
$sql = "select * from atletconnect.tbaluno where email = '$logado'";
$result = $conexao->query($sql);

$info = mysqli_fetch_assoc($result) ?>

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

<?php } ?>

    </header>
    <content>
        <div class="conteudo" style="background-image: none;">
            <div class="conteudo-titulo-maior" style="margin-bottom: 1%;"> Modalidades. </div>
        <div class="carrosel">
                <div class="owl-carousel owl-theme">

                <?php if((!isset($_SESSION['email']) != true) and (!isset($_SESSION['senha']) != true)) { ?>

                    <div class="item"><div class="modalidade-card" id="card-1"><div class="modalidade-card-faixa"><a href="./modalidade-esporte.php?mod=1">Vôlei masculino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-2"><div class="modalidade-card-faixa"><a href="./modalidade-esporte.php?mod=3">Futsal masculino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-3"><div class="modalidade-card-faixa"><a href="./modalidade-esporte.php?mod=5">Basquete masculino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-1"><div class="modalidade-card-faixa"><a href="./modalidade-esporte.php?mod=2">Vôlei feminino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-2"><div class="modalidade-card-faixa"><a href="./modalidade-esporte.php?mod=4">Futsal feminino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-3"><div class="modalidade-card-faixa"><a href="./modalidade-esporte.php?mod=6">Basquete feminino</a></div>
                    </div> </div>

                <?php } else { ?>
                    <div class="item"><div class="modalidade-card" id="card-1"><div class="modalidade-card-faixa"><a onclick="acessoNegado();">Vôlei masculino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-2"><div class="modalidade-card-faixa"><a onclick="acessoNegado();">Futsal masculino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-3"><div class="modalidade-card-faixa"><a onclick="acessoNegado();">Basquete masculino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-1"><div class="modalidade-card-faixa"><a onclick="acessoNegado();">Vôlei feminino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-2"><div class="modalidade-card-faixa"><a onclick="acessoNegado();">Futsal feminino</a></div>
                    </div> </div>
                    <div class="item"><div class="modalidade-card" id="card-3"><div class="modalidade-card-faixa"><a onclick="acessoNegado();">Basquete feminino</a></div>
                    </div> </div>

                <?php } ?>

                </div>
            </div>
            <img src="../../images/pessoas-bandeiras.svg" alt="Atleta" class="conteudo-foto-modalidade">
        </div>
    </content>
    <script src="../../js/lib/jquery/jquery.min.js"></script>
    <script src="../../js/lib/owlCarousel/dist/owl.carousel.min.js"></script>
    <script type="text/javascript">

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoWidth: true,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 3500,
            autoplayHoverPause: false,
            responsive:{
                0:{
                    items:1
             },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })

    </script>
</body>
</html>