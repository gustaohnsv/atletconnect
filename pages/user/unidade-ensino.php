<?php

    include_once('./config.php');
    session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/style-ude.css" type="text/css">
    <link rel="shortcut icon" href="../../images/logo-azul.png" type="image/x-icon">
    <title>AtletConnect</title>
</head>
<body style="background-image: none;">
    <header>
    <?php

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) { ?>

<div class="cabecalho" style="margin-top: 2%;">
    <div class="cabecalho-logo">
        <img src="../../images/logo-azul.png" alt="Logo" class="cabecalho-logo" style="width: 50px;" id="cabecalho-logo"> 
        <!-- <span class="cabecalho-texto"> AtletConnect. </span> -->
    </div>
    <ul  style="list-style: none">
        <li>
            <a href="./modalidade.php" class="cabecalho-itens"> Modalidades </a>
        </li>
        <li>
            <a href="./homepage.php" class="cabecalho-itens"> Home </a>
        </li>
        <li>
            <input type="button" value="Cadastre-se" class="cabecalho-botao">
    </ul>
</div>

<?php } else {

$logado = $_SESSION['email'];
$sql = "select * from atletconnect.tbaluno where email = '$logado'";
$result = $conexao->query($sql);

?>

<?php while($info = mysqli_fetch_assoc($result)) { ?>

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

<?php } } ?>

    </header>
    <content>
        <div class="ude">
            <div class="ude-conteudo">
                <div class="ude-conteudo-titulo">
                        <span> Unidade de ensino </span>
                    </div>
                    <div class="ude-conteudo-texto">
                        <p> No sadipscing takimata elitr amet magna consetetur sit est justo. Dolore clita dolor ut ipsum at tempor, ut erat duo consetetur et clita, diam nonumy diam justo ut sadipscing. Accusam et dolore clita diam gubergren justo sed. Diam lorem diam et lorem aliquyam est sadipscing. Labore labore sed sit aliquyam gubergren et labore erat gubergren, at labore eos at sea ut, tempor vero est vero tempor. Invidunt sea nonumy et sed, sit est aliquyam elitr sea consetetur diam. Consetetur ut et aliquyam sed diam ipsum eirmod ea stet, erat sea eos tempor ipsum justo. Ipsum justo amet no eos. Aliquyam. </p>
                    </div>
                </div>
            <div class="ude-conteudo-mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3658.5256235321776!2d-46.34573398449449!3d-23.51359016571616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce7b3d56997a17%3A0x54f4214e9220a7f2!2zRVRFQyBQb8Oh!5e0!3m2!1spt-BR!2sbr!4v1663977017692!5m2!1spt-BR!2sbr" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </content>
</body>
</html>