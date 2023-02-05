<?php

    include_once("../user/config.php");
    session_start();

    if((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true)) {      
        header('Location: ../user/homepage.php');
    }

    $logado = $_SESSION['email'];

    if(isset($_POST['volei'])) {
        $mod = 'volei';
        $sqlVolei = "select atletconnect.tbateqp.idateqp ,atletconnect.tbaluno.idAluno, atletconnect.tbaluno.nome, atletconnect.tbaluno.sobrenome, atletconnect.tbaluno.RG, atletconnect.tbaluno.path,  atletconnect.tbequipe.esporte, atletconnect.tbequipe.genero, atletconnect.tbequipe.periodo from atletconnect.tbateqp, atletconnect.tbaluno, atletconnect.tbequipe where atletconnect.tbequipe.esporte = 'Volei' and atletconnect.tbaluno.idAluno = atletconnect.tbateqp.idAluno and atletconnect.tbequipe.idEquipe = atletconnect.tbateqp.idEquipe";
        $result = $conexao->query($sqlVolei);
    }

    else if(isset($_POST['futsal'])) {
        $mod = 'futsal';
        $sqlFutsal = "select atletconnect.tbateqp.idateqp ,atletconnect.tbaluno.idAluno, atletconnect.tbaluno.nome, atletconnect.tbaluno.sobrenome, atletconnect.tbaluno.RG, atletconnect.tbaluno.path,  atletconnect.tbequipe.esporte, atletconnect.tbequipe.genero, atletconnect.tbequipe.periodo from atletconnect.tbateqp, atletconnect.tbaluno, atletconnect.tbequipe where atletconnect.tbequipe.esporte = 'Futsal' and atletconnect.tbaluno.idAluno = atletconnect.tbateqp.idAluno and atletconnect.tbequipe.idEquipe = atletconnect.tbateqp.idEquipe";
        $result = $conexao->query($sqlFutsal);
    }

    else if(isset($_POST['basquete'])) {
        $mod = 'basquete';
        $sqlBasquete = "select atletconnect.tbateqp.idateqp ,atletconnect.tbaluno.idAluno, atletconnect.tbaluno.nome, atletconnect.tbaluno.sobrenome, atletconnect.tbaluno.RG, atletconnect.tbaluno.path,  atletconnect.tbequipe.esporte, atletconnect.tbequipe.genero, atletconnect.tbequipe.periodo from atletconnect.tbateqp, atletconnect.tbaluno, atletconnect.tbequipe where atletconnect.tbequipe.esporte = 'Basquete' and atletconnect.tbaluno.idAluno = atletconnect.tbateqp.idAluno and atletconnect.tbequipe.idEquipe = atletconnect.tbateqp.idEquipe";
        $result = $conexao->query($sqlBasquete);
    }
    
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
                <form action="#" method="post">
                <div class="sistema-func-cabecalho" style="margin-top: 10%;">
                <img src="../../images/logo.png" alt="Logo na cor branca.">
                <!-- <div class="sistema-func-titulo">
                    <span> Funcionalidades </span>
                    <hr>
                -->
                </div>
                <div class="sistema-func-conteudo">
                <div class="sistema-func-titulo">
                    <span> Equipes </span>
                    <hr>
                </div>
                <!---
                <input type="text" name="busca" id="busca" placeholder="ID da Modalidade." title="Insira o ID da modalidade" style="margin-bottom: 5%;" required>
                <input type="submit" value="Buscar" style="margin-bottom: 5%;">
                -->
                <input type="submit" value="Vôlei" name="volei" style="margin-bottom: 5%;">
                <input type="submit" value="Futsal" name="futsal" style="margin-bottom: 5%;">
                <input type="submit" value="Basquete" name="basquete" style="margin-bottom: 5%;">
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

                                    if($result->num_rows < 1) {
                                        echo "<h3> A tabela abaixo não possui registros para serem visualizados . </h3>";
                                    }

                                ?>
                        </tbody>
                </table>
                <div class="sistema-tab-rodape">
                    <form action="./sistema.php" method="post">
                    <label for=""> Informe o ID do aluno(a): </label>
                    <input type="number" name="id" id="id" style="margin: 0 8px 0 8px;">
                    <input type="submit" name="buscar-aluno" value="Buscar por aluno" class="sistema-tab-rodape-busca">
                    <!--
                    <div class="sistema-tab-rodape-crud">
                        <button type="submit" name="conceder-cargo" id="conceder-cargo"> 
                            <img src="../../images/estrela-bandeira.svg"  title="Conceder cargo" alt="Conceder cargo">
                        </button>
                    </div>
                    <div class="sistema-tab-rodape-crud">
                    <button type="submit" name="remover-cargo" id="remover-cargo"> 
                            <img src="../../images/remover-bandeira.svg"  title="Remover cargo" alt="Remover cargo">
                        </button>
                    </div>
                    <div class="sistema-tab-rodape-crud">
                    <button type="submit" name="editar-registro" id="editar-registro"> 
                            <img src="../../images/perfil-editar.svg"  title="Editar registro" alt="Editar registro">
                        </button>
                    </div>
                    <div class="sistema-tab-rodape-crud">
                    <button type="submit" name="deletar-registro" id="deletar-registro"> 
                            <img src="../../images/perfil-excluir.svg"  title="Deletar registro" alt="Deletar registro">
                        </button>
                    </div>
                    -->
                    <div class="sistema-tab-rodape-crud">
                    <button type="submit" name="remover-equipe" id="remover-equipe"> 
                            <img src="../../images/perfil-modalidade.svg"  title="Remover da equipe" alt="Remover da equipe">
                        </button>
                    </div>
                    </form>
                    <form action="./sistema-lista.php?mod=<?php echo $mod; ?>" method="post">
                    <div class="sistema-tab-rodape-crud">
                    <button type="submit" name="tabela-modalidade" id="tabela-geral"> 
                            <img src="../../images/download.svg" alt="Download" title="Baixar tabela">
                    </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </content>
</body>
</html>