<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css" type="text/css">
    <link rel="stylesheet" href="../../styles/style-sistema.css" type="text/css">
    <link rel="shortcut icon" href="../../images/logo-azul.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>AtletConnect</title>
    <script> 

        function msgConfirmar(type, title, msg, title2, msg2){

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
            )}  
        })
        }

    </script>
</head>
<body>
    <script src="../../js/custom.js"></script>
    <script src="../../js/sweetalert2.js"></script>
<?php

    include_once("../user/config.php");
    session_start();

    if((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true)) {      
        header('Location: ../user/homepage.php');
    }

    $logado = $_SESSION['email'];

        $sqlProf = "select atletconnect.tbprof.cargo from atletconnect.tbprof where email = '$logado'";
        $resultProf = $conexao->query($sqlProf);
        $permissao = '1';

        if ($resultProf->num_rows < 1) {

            $sqlAluno = "select atletconnect.tbaluno.cargo from atletconnect.tbaluno where email = '$logado'";
            $resultAluno = $conexao->query($sqlAluno);
            $infoAluno = mysqli_fetch_assoc($resultAluno);
            $permissao = '0';

            if ($resultAluno->num_rows < 1) {

                header("Location: ../user/homepage.php");

            }

        }

    if(isset($_POST['buscar-aluno'])) {

        $idAluno = $_POST['id'];

        if($_POST['id'] != "" && $_POST['id'] > 0) {   

        $sqlBusca = "select * from atletconnect.tbaluno where idAluno = '$idAluno'";
        $result = $conexao->query($sqlBusca);

        if (mysqli_num_rows($result) < 1) {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idInvalido();
        }

        }

        else {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idVazio();
        }

    }

    else if(isset($_POST['conceder-cargo'])) {
        
        $idAluno = $_POST['id'];

        if($_POST['id'] != "" && $_POST['id'] > 0) {

        $sqlBusca = "select * from atletconnect.tbaluno where idAluno = '$idAluno'";
        $result = $conexao->query($sqlBusca);

        if (mysqli_num_rows($result) < 1) {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idInvalido();
        } else {

        $sqlConcederCargo = "update atletconnect.tbaluno set cargo = 'admin' where idAluno = '$idAluno'";
        $result = $conexao->query($sqlConcederCargo);
        $sqlBuscarAluno = "select nome, sobrenome from atletconnect.tbaluno where idAluno = '$idAluno'";
        $resultBuscarAluno = $conexao->query($sqlBuscarAluno);
        $novoAdm = mysqli_fetch_assoc($resultBuscarAluno);
        $nomeAdm = $novoAdm['nome'] . " " . $novoAdm['sobrenome'];
        echo "<script> msgSucesso('success', 'Sucesso!', 'Agora o(a) $nomeAdm é um administrador também!'); </script>";
        $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
        $result = $conexao->query($sqlBusca);

        }

        }

        else {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idVazio();
        }

    }

    else if(isset($_POST['remover-cargo'])) {
                
        $idAluno = $_POST['id'];

        if($_POST['id'] != "" && $_POST['id'] > 0) {

        $sqlBusca = "select * from atletconnect.tbaluno where idAluno = '$idAluno'";
        $result = $conexao->query($sqlBusca);

        if (mysqli_num_rows($result) < 1) {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idInvalido();
        } else {

        $sqlConcederCargo = "update atletconnect.tbaluno set cargo = null where idAluno = '$idAluno'";
        $result = $conexao->query($sqlConcederCargo );
        echo "<script> msgSucesso('success','Cargo removido!','Cargo de administrador removido do usuário.'); </script>";
        $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
        $result = $conexao->query($sqlBusca);

        }

        }

        else {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idVazio();
        }

    }

    else if(isset($_POST['editar-registro'])) {

        $idAluno = $_POST['id'];

        if($_POST['id'] != "" && $_POST['id'] > 0) {

            $sqlBusca = "select * from atletconnect.tbaluno where idAluno = '$idAluno'";
            $result = $conexao->query($sqlBusca);
    
            if (mysqli_num_rows($result) < 1) {
                $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
                $result = $conexao->query($sqlBusca);
                idInvalido();
            } else {

            header("Location: sistema-editar-perfil?id=$idAluno");

            }

        }

        else {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idVazio();
        }

    }

    else if(isset($_POST['deletar-registro'])) {

        $idAluno = $_POST['id'];

        if($_POST['id'] != "" && $_POST['id'] > 0) {

        $sqlBusca = "select * from atletconnect.tbaluno where idAluno = '$idAluno'";
        $result = $conexao->query($sqlBusca);

        if (mysqli_num_rows($result) < 1) {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idInvalido();
        } else {
        
        $sqlDeletar1 = "delete from atletconnect.tbateqp where idAluno = '$idAluno'";
        $result1 = $conexao->query($sqlDeletar1);
        $sqlDeletar2 = "delete from atletconnect.tbaluno where idAluno = '$idAluno'";
        $result2 = $conexao->query($sqlDeletar2);
        echo "<script> msgSucesso('success','Sucesso!','Registro deletado com sucesso.'); </script>";
        $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
        $result = $conexao->query($sqlBusca);

        }

        }

        else {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idVazio();
        }

    }

    else if(isset($_POST['remover-equipe'])) {

        $idAluno = $_POST['id'];

        if($_POST['id'] != "" && $_POST['id'] > 0) {

        $sqlDeletar = "delete from atletconnect.tbateqp where idAluno = '$idAluno'";
        $result = $conexao->query($sqlDeletar);
        echo "<script> msgSucesso('success','Sucesso!','Usuário removido da equipe!'); </script>";
        $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
        $result = $conexao->query($sqlBusca);

        }

        else {
            $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
            $result = $conexao->query($sqlBusca);
            idVazio();
        }

    }

    else {
        $sqlBusca = "select * from atletconnect.tbaluno order by idAluno DESC";
        $result = $conexao->query($sqlBusca);
    }

    function idVazio() {
        echo "<script> msgErro('error','ID Inválido!','Insira um ID válido para continuar.'); </script>";
    }

    function idInvalido() {
        echo "<script> msgErro('error','ID não encontrado!','O ID digitado não está no banco de dados, tente novamente.'); </script>";
    }

?>
    <content>
        <div class="sistema">
            <div class="sistema-func">
                <div class="sistema-func-caixa">
                <form action="./sistema-modalidade.php" method="post">
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
                </div>
                </form>
                </div>
            </div>
            <div class="sistema-tab">
                <table class="sistema-conteudo-tabela">
                        <thead>
                                   <tr>
                                        <th class="id">ID</th>
                                        <th class="nome">Nome</th>
                                        <th class="celular">Celular</th>
                                        <th>RG</th>
                                        <th>Email</th>
                                        <th>RM</th>
                                        <th>Nascimento</th>
                                        <th>Turno</th>
                                        <th>Curso</th>
                                        <th>Serie</th>
                                        <th>Cargo</th>
                                        <th>Foto</th>
                                    </tr> 
                        </thead>
                        <tbody>
                                <?php

                                    while($user_data = mysqli_fetch_assoc($result)) {

                                        echo "<tr>";

                                        echo "<td>".$user_data['idAluno']."</td>";
                                        echo "<td>".$user_data['nome']." ".$user_data['sobrenome']."</td>";
                                        echo "<td>".$user_data['celular']."</td>";
                                        echo "<td>".$user_data['RG']."</td>";
                                        echo "<td>".$user_data['email']."</td>";
                                        echo "<td>".$user_data['RM']."</td>";
                                        echo "<td>".$user_data['datanasc']."</td>";
                                        echo "<td>".$user_data['turno']."</td>";
                                        echo "<td>".$user_data['curso']."</td>";
                                        echo "<td>".$user_data['serie']."</td>";
                                        echo "<td>".$user_data['cargo']."</td>";
                                        echo "<td> <img src=".$user_data['path']."> </td>";
                                        /*  echo "<td> $mens </td>"; */
                                        echo "</tr>";

                                    }

                                ?>

                        </tbody>
                </table>
                <div class="sistema-tab-rodape">
                    <form action="./sistema.php" method="post" class="botoes-crud">
                    <label for=""> Informe o ID do aluno(a): </label>
                    <input type="number" name="id" id="id" style="margin: 0 8px 0 8px;">
                    <input type="submit" name="buscar-aluno" value="Buscar por aluno" class="sistema-tab-rodape-busca">
                    <div class="sistema-tab-rodape-crud">
                        <?php if ($permissao == '1') { ?>   
                        <button type="submit" name="conceder-cargo" id="conceder-cargo"> 
                            <img src="../../images/estrela-bandeira.svg"  title="Conceder cargo" alt="Conceder cargo">
                        </button>
                    </div>
                    <div class="sistema-tab-rodape-crud">
                    <button type="submit" name="remover-cargo" id="remover-cargo"> 
                            <img src="../../images/remover-bandeira.svg"  title="Remover cargo" alt="Remover cargo">
                        </button>
                    </div>
                    <?php } ?>
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
                    </form>
                    <form action="./sistema-lista-geral.php" method="post">
                    <div class="sistema-tab-rodape-crud">
                    <button type="submit" name="tabela-geral" id="tabela-geral"> 
                            <img src="../../images/download.svg" alt="Download" title="Baixar tabela">
                    </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </content>
    <script src="../../js/lib/jquery/jquery.min.js"></script>
    <script src="../../js/convert-pdf.js"></script>
</body>
</html>