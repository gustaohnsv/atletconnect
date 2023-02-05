<?php

    include_once("../user/config.php");
    session_start();

    if((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true)) {      
        header('Location: ../user/homepage.php');
    }

    $logado = $_SESSION['email'];

    if(isset($_POST['tabela-modalidade'])) {

        if ($_GET['mod'] == 'volei') {
            $sqlVolei = "select atletconnect.tbateqp.idateqp ,atletconnect.tbaluno.idAluno, atletconnect.tbaluno.nome, atletconnect.tbaluno.sobrenome, atletconnect.tbaluno.RG, atletconnect.tbaluno.path,  atletconnect.tbequipe.esporte, atletconnect.tbequipe.genero, atletconnect.tbequipe.periodo from atletconnect.tbateqp, atletconnect.tbaluno, atletconnect.tbequipe where atletconnect.tbequipe.esporte = 'Volei' and atletconnect.tbaluno.idAluno = atletconnect.tbateqp.idAluno and atletconnect.tbequipe.idEquipe = atletconnect.tbateqp.idEquipe";
            $result = $conexao->query($sqlVolei);
        }

        else if ($_GET['mod'] == 'futsal') {
            $sqlVolei = "select atletconnect.tbateqp.idateqp ,atletconnect.tbaluno.idAluno, atletconnect.tbaluno.nome, atletconnect.tbaluno.sobrenome, atletconnect.tbaluno.RG, atletconnect.tbaluno.path,  atletconnect.tbequipe.esporte, atletconnect.tbequipe.genero, atletconnect.tbequipe.periodo from atletconnect.tbateqp, atletconnect.tbaluno, atletconnect.tbequipe where atletconnect.tbequipe.esporte = 'Futsal' and atletconnect.tbaluno.idAluno = atletconnect.tbateqp.idAluno and atletconnect.tbequipe.idEquipe = atletconnect.tbateqp.idEquipe";
            $result = $conexao->query($sqlVolei);
        }

        else if ($_GET['mod'] == 'basquete') {
            $sqlVolei = "select atletconnect.tbateqp.idateqp ,atletconnect.tbaluno.idAluno, atletconnect.tbaluno.nome, atletconnect.tbaluno.sobrenome, atletconnect.tbaluno.RG, atletconnect.tbaluno.path,  atletconnect.tbequipe.esporte, atletconnect.tbequipe.genero, atletconnect.tbequipe.periodo from atletconnect.tbateqp, atletconnect.tbaluno, atletconnect.tbequipe where atletconnect.tbequipe.esporte = 'Basquete' and atletconnect.tbaluno.idAluno = atletconnect.tbateqp.idAluno and atletconnect.tbequipe.idEquipe = atletconnect.tbateqp.idEquipe";
            $result = $conexao->query($sqlVolei);
        }

    }

        
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/stylea-sistema.css" type="text/css">
    <link rel="stylesheet" href="../../styles/style-lista.css" type="text/css">
    <link rel="shortcut icon" href="../../images/logo-azul.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>AtletConnect</title>
</head>
<body style="background-image: none;">
    <content>
        <div class="sistema">
            <div class="sistema-tab">
                <table class="sistema-conteudo-tabela">
                        <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>RG</th>
                                        <th>Esporte</th>
                                        <th>Gênero</th>
                                        <th>Período</th>
                                        <th>Foto</th>
                                    </tr>
                        </thead>
                        <tbody>
                                <?php

                                    while($user_data = mysqli_fetch_assoc($result)) {

                                        echo "<tr>";
                                        echo "<td>".$user_data['idAluno']."</td>";
                                        echo "<td>".$user_data['nome']." ".$user_data['sobrenome']."</td>";
                                        echo "<td>".$user_data['RG']."</td>";
                                        echo "<td>".$user_data['esporte']."</td>";
                                        echo "<td>".$user_data['genero']."</td>";
                                        echo "<td>".$user_data['periodo']."</td>";
                                        echo "<td> <img src=".$user_data['path']." alt='Aluno(a) sem foto.'> </td>";
                                        echo "</tr>";
                                    }

                                ?>
                        </tbody>
                </table>
            </div>
            <div class="sistema-botoes">
            <button onclick="downloadPDF();"> Download </button>
            <a href="./sistema.php"> Voltar para o sistema </a>
            </div>
        </div>
    </content>
    <script src="../../js/convert-pdf.js"></script>
</body>
</html>