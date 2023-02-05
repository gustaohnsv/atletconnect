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
    <link rel="stylesheet" href="../../styles/style-modal.css" type="text/css">
    <link rel="shortcut icon" href="../../images/logo-azul.png" type="image/x-icon">
    
    <title>AtletConnect</title>
</head>
<script src="https://kit.fontawesome.com/00fc5dfa0b.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<body style="background-image: none;">
    <script src="../../js/custom.js"></script>
    <script src="../../js/sweetalert2.js"></script>
    <header>
        <?php

            unset($_SESSION['email']); 
            unset($_SESSION['senha']);
            
            if((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true)) { ?>

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
                        <a href="./unidade-ensino.php" class="cabecalho-itens"> Unidades de ensino </a>
                    </li>
                    <li>
                        <a href="#rodape" class="cabecalho-itens"> Suporte </a>
                    </li>
                    <li>
                        <a href="#nossa-equipe" class="cabecalho-itens"> Sobre nós </a>
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
            </div>
            <ul  style="list-style: none">
                <li>
                    <a href="./modalidade.php" class="cabecalho-itens"> Modalidades </a>
                </li>
                <li>
                    <a href="#rodape" class="cabecalho-itens"> Suporte </a>
                </li>
                <li>
                    <a href="./unidade-ensino.php" class="cabecalho-itens"> Unidades de ensino </a>
                </li>
                <li>
                    <a href="./homepage.php" class="cabecalho-itens"> Home </a>
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
        <div class="conteudo">
            <div class="conteudo-titulo-menor"> Faça parte do </div>
            <div class="conteudo-titulo-maior"> AtletConnect. </div>
        <div class="conteudo-texto">
            Uma plataforma que reúne em um só lugar o melhor para a organização de eventos esportivos dentro das escolas, com um ambiente preparado para receber e unificar os dados de todos os atletas, acabando de vez com a perca de informações importantes.
        </div>
        <div class="formulario">
            <form action="./homepage.php" method="POST" class="conteudo-formulario" id="form">

                <div class="form-control">
                    <input type="text" name="email" id="email" placeholder="E-mail" class="conteudo-formulario-input">
                    <span> Mensagem de erro! </span>
                </div>

                <div class="form-control">
                    <input type="password" name="senha" id="senha" placeholder="Senha" class="conteudo-formulario-input">
                    <span> Mensagem de erro! </span>
                </div>

                <input type="submit" value="Login" name="botao-login" id="botao-login"> 
                
            </form>

            <?php

                    if(isset($_POST['botao-login'])) {
                
                        include_once('./config.php');
                
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];
                
                        //print_r("<br>");
                        //print_r('Email: ' . $email);
                        //print_r("<br>");
                        //print_r('Senha: ' . $senha);
                
                        $sqlProf = "select * from atletconnect.tbprof where email = '$email' and senha = '$senha'";
                        $resultProf = $conexao->query($sqlProf);
                
                    if(mysqli_num_rows($resultProf) < 1) {
                
                        $sql = "select * from atletconnect.tbaluno where email = '$email' and senha = '$senha'";
                        $result = $conexao->query($sql);
                
                        if(mysqli_num_rows($result) < 1) {
                                echo "<script> msgErro('error','Erro!','Email ou senhas incorretos!'); </script>";
                            }
                            
                            else {
                                $_SESSION['email'] = $email;
                                $_SESSION['senha'] = $senha;
                                header('Location: perfil.php');
                            }
                
                        }
                
                    else {
                        $_SESSION['email'] = $email;
                        $_SESSION['senha'] = $senha;
                        header('Location: ../admin/sistema.php');
                    }
                
                    }

            ?>
        </div>
        <div class="conteudo-formulario-direita">
            <img src="../../images/homepage.svg" alt="Atleta" 
        class="conteudo-foto">
        </div>
        <!--
        <div class="conteudo-link">
            <a href="#"> Esqueceu sua senha? </a>
        </div>
        -->
    </div>
    <div class="nossa-equipe" id="nossa-equipe">
        <span class="nossa-equipe-titulo-maior"> Nossa Equipe </span>
        <div class="nossa-equipe-port">
            <div class="nossa-equipe-foto">
                <img src="../../images/anthony.png" alt="Perfil da equipe">
                <span> Anthony Oliveira </span>
            </div>
            <div class="nossa-equipe-foto">
                <img src="../../images/bruno.png" alt="Perfil da equipe">
                <span> Bruno Saladino </span>
            </div>
            <div class="nossa-equipe-foto">
                <img src="../../images/gustavo.png" alt="Perfil da equipe">
                <span> Gustavo Henriques </span>
            </div>
            <div class="nossa-equipe-foto">
                <img src="../../images/julio.png" alt="Perfil da equipe">
                <span> Júlio Sandoli </span>
            </div>
        </div>
        <div class="nossa-equipe-texto">
            <div class="nossa-equipe-texto-conteudo">
                Nós somos a equipe SSA, que significa Scholar Sport Access, o nome remete a ideia do nosso projeto, que é entregar um acesso sofisticado e prático, totalmente informatizado para facilitar a organização do esporte dentro das escolas. <br> <br>
                As nossas soluções permitem otimizar o tempo dos profissionais de educação física no agrupamento das informações de seus alunos, por meio de uma plataforma objetiva, entregando objetividade e agilidade à experiência do cliente.
            </div>
        </div>
    </div>
    <div class="faq" id="faq">
        <span class="faq-titulo-maior"> Perguntas Frequentes </span>
        <div class="faq-conteudo">
            <div class="faq-conteudo-linha">
                <div class="faq-conteudo-texto">
                    <div class="faq-texto-titulo"> Quem deve se cadastrar nesse site? </div>
                    <p> - Todos os alunos que fazem parte de alguma equipe esportiva dentro da sua instituição de ensino
                    </p>
                </div>
                <div class="faq-conteudo-texto">
                    <div class="faq-texto-titulo"> Por que devo dar minhas informações pessoais? </div>
                    <p> - Todos esses dados são necessários para que o professor responsável faça a inscrição do atleta nas competições 
                    </p>
                </div>
            </div>
            <div class="faq-conteudo-linha">
                <div class="faq-conteudo-texto">
                    <div class="faq-texto-titulo"> Posso me inscrever em mais de uma modalidade? </div>
                    <p> - Você pode se inscrever em quantas modalidades for necessário, contanto que esteja participando dos treinos das mesmas na escola.
                    </p>
                </div>
                <div class="faq-conteudo-texto">
                    <div class="faq-texto-titulo"> Como criar uma conta no site? </div>
                    <p> - É necessário colocar seus dados na área de cadastro, um email válido, uma senha e também o seu registro escolar, restringindo a uma conta por aluno.
                    </p>
                </div>
            </div>
            <div class="faq-conteudo-linha">
                <div class="faq-conteudo-texto">
                    <div class="faq-texto-titulo"> Existe alguma taxa de adesão? </div>
                    <p> - Não, nosso site é totalmente gratuito para todos os alunos, sendo necessário apenas o cadastro para fazer uso.
                    </p>
                </div>
                <div class="faq-conteudo-texto">
                    <div class="faq-texto-titulo"> Posso utilizar o site sem fazer o cadastro? </div>
                    <p> - Neste caso apenas poderá ver algumas partes do site, porém se inscrever em modalidades e fazer alterações no perfil, apenas com um cadastro válido.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </content>
    <footer class="rodape" id="rodape">
        <div class="rodape-conteudo">
            <div class="rodape-conteudo-esquerda">
                <div class="rodape-conteudo-esquerda-marca">
                    <a target="_blank" href="../../documents/termo-de-uso.pdf" rel="noopener noreferrer" style="margin-left: 4px; margin-right: 4px"> Termos de uso </a>
                    <span style="margin-left: 4px; margin-right: 4px"> (11) 91234-5678 </span>
                    <span style="margin-left: 4x; margin-right: 4px"> atletconnect@gmail.com </span>
                </div>
            </div>
            <div class="rodape-conteudo-direita">
                <div class="rodape-conteudo-direita-marca">
                    <span> 2022 AtletConnect©. Todos os direitos reservados </span>
                </div>
            </div>
        </div>
    </footer>
    <div class="cadastro">
        <div class="cadastro-popup">
            <div class="cadastro-popup-fechar"> x </div>
            <div class="cadastro-popup-conteudo">
                <div class="cadastro-popup-formulario">
                    <div class="cadastro-popup-formulario-titulo"> 
                        <span class="cadastro-popup-formulario-titulo-maior"> Crie sua conta </span> <br>
                        <span class="cadastro-popup-formulario-titulo-menor"> Faça já sua conta rápido e fácil! </span>
                    </div>
                    <form action="./homepage.php" class="cadastro-popup-formulario-conteudo" method="POST" id="formulario-1">

                        <div class="cadastro-popup-formulario-linha">
                            <div class="input-label">
                                <label for=""> Nome: </label>
                                <input type="text" placeholder="Digite seu nome*" title="O nome deve conter apenas letras." name="nome" id="nome" required>
                            </div>
                            <div class="input-label">
                                <label for=""> Sobrenome: </label>
                                <input type="text" placeholder="Digite seu sobrenome*" title="O sobrenome deve conter apenas letras." name="sobrenome" id="sobrenome" required>
                            </div>
                         </div>

                         <div class="cadastro-popup-formulario-linha">
                            <div class="input-label">
                                <label for=""> Celular: </label>
                                <input type="tel" class="celular" placeholder="Insira seu telefone*" maxlength="11" title="Insira um número de telefone celular." name="celular" id="celular" required>
                            </div>
                            <div class="input-label">
                                <label for=""> RG: </label>
                            <input type="text" class="rg" placeholder="Insira seu RG*" maxlength="11" title="Insira um RG válido." name="rg" id="rg" required>
                            </div>
                        </div>

                        <div class="cadastro-popup-formulario-linha">
                            <div class="input-label">
                                <label for=""> Email: </label>
                                <input type="email" placeholder="Digite seu e-mail*" title="Insira um endereço de email válido." name="email-cadastro" id="email-cadastro" required>
                            </div>
                            <div class="input-label">
                                <label for=""> Registro de matrícula: </label>
                                <input type="number" class="rm" placeholder="Insira seu RM*" name="rm" id="rm" required>
                            </div>
                        </div>

                        <div class="cadastro-popup-formulario-linha">
                            <div class="input-label">
                                <label for=""> Senha: </label>
                                <input type="password" placeholder="Digite sua senha*" title="A senha deve conter pelo menos uma letra maiúscula e minúscula, um número e deve ter entre 8 a 12 caracteres." name="senha-cadastro" id="senha-cadastro" required>
                            </div>
                            <div class="input-label">
                                <label for=""> Confirme a senha: </label>
                                <input type="password" placeholder="Confirme sua senha*" title="Confirme a sua senha." name="senha-cadastro-confirmar" id="senha-cadastro-confirmar" required>
                            </div>
                        </div>

                        <div class="cadastro-popup-formulario-linha">
                            <div class="input-label">
                                <label for=""> Data de nascimento: </label>
                                <input type="date" name="datanasc" class="datanasc"  id="datanasc" required>
                            </div>
                            <div class="input-label">
                                <label for=""> Turno: </label>
                                <select name="turno" id="turno" required>
                                    <option value="" disabled selected> Turno* </option>
                                    <option value="Manhã"> Manhã </option>
                                    <option value="Tarde"> Tarde </option>
                                    <option value="Noite"> Noite </option>
                                </select>
                            </div>
                        </div>

                        <div class="cadastro-popup-formulario-linha">
                            <div class="input-label">
                                <label for=""> Curso: </label>
                                <select name="curso" id="curso" required>
                                    <option value="" disabled selected> Curso* </option>
                                    <option value="Desenvolvimento de Sistemas"> DS </option>
                                    <option value="Administração"> ADM</option>
                                    <option value="Densenvolvimento de Sistemas - Noturno"> DS - Noturno</option>
                                    <option value="Administração - Noturno"> ADM - Noturno </option>
                                    <option value="Infonet"> Infonet </option>
                                    <option value="Marketing"> Marketing </option>
                                </select>
                            </div>
                            <div class="input-label">
                                <label for=""> Série: </label>
                                <select name="serie" id="serie" required> 
                                    <option value="" disabled selected> Turma* </option>
                                    <option value="Primeiro"> Primeiro </option>
                                    <option value="Segundo"> Segundo </option>
                                    <option value="Terceiro"> Terceiro </option>
                                </select>
                            </div>
                        </div>

                        <div class="cadastro-popup-formulario-termos">
                            <div class="botao-termos">
                                <input type="checkbox" name="termos" id="termos" required>
                            </div> 

                            <p style="margin: 0; padding: 0;">
                                Li e concordo com os <a target="_blank" href="../../documents/termo-de-uso.pdf" rel="noopener noreferrer"> termos de serviço </a> e a <a target="_blank" href="../../documents/termo-de-uso.pdf" rel="noopener noreferrer"> política de privacidade </a> do AtletConnect.
                            </p>
                        </div>
                        <div class="cadastro-popup-formulario-rodape">
                            <input type="button" value="Voltar" class="cadastro-popup-formulario-voltar">
                            <input type="submit" value="Criar conta" name="botao-cadastro" id="botao-cadastro">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php

    if(isset($_POST['botao-cadastro'])) {

        include_once('./config.php');

        /*$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(empty($dados)) {
            $retorna = ['status'=> false, 'msg' => "Erro: Houve um erro na hora de cadastrar!"];
        }else{
            $retorna = ['status' => true, 'msg' => "Usuário cadastro com sucesso!"];
        }

        echo json_encode($retorna); */

        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $celular = $_POST['celular'];
        $rg = strtoupper($_POST['rg']);
        $email = $_POST['email-cadastro'];
        $rm = $_POST['rm'];
        $senha = $_POST['senha-cadastro'];
        $datanasc = $_POST['datanasc'];
        $turno = $_POST['turno'];
        $curso = $_POST['curso'];
        $serie = $_POST['serie'];

        $senhaConfirmar = $_POST['senha-cadastro-confirmar'];

        if ($senha === $senhaConfirmar) {

        $result = mysqli_query($conexao, "insert into atletconnect.tbaluno (nome,sobrenome,celular,RG,email,RM,senha,datanasc,turno,curso,serie) values ('$nome', '$sobrenome', '$celular', '$rg', '$email', '$rm', '$senha', '$datanasc', '$turno', '$curso', '$serie')");
        echo "<script> msgSucesso('success', 'Feito!', 'Cadastro efetuado com sucesso!'); </script>";

        }
        else {
            echo "<script> msgErro('error', 'Ops!', 'As senhas digitadas são diferentes, tente novamente!'); </script>";
        }
}

?>

    <!--<script src="../../js/lib/jquery/jquery.min.js"></script> -->
    <!-- <script src="../../js/invalid-input.js"></script> -->
    <script src="../../js/homepage-modal.js"></script>
    <script src="../../js/input-masks.js"></script>
    <script src="../../js/invalid-input-modal.js"></script>
</body>
</html>