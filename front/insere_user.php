<!--Dayna Caroline - N°11 - Criação: 02/09-->
<!--Augusto Creppe - N°06 e Dayna Caroline - N°11 - Atualização: 09/09-->

<!DOCTYPE html>

<?php
    include "../back/conexao.php";

    $logado = null;

    session_start();
    
    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $adm = $_SESSION['adm'];
        $nome = $_SESSION['nome']; 
        $sexo = $_SESSION['sexo'];
        $id_user = $_SESSION['id_user'];
    }
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cup&Mug</title>
        <link rel="stylesheet" href="../styles/insere_user.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>

    <body>
        <div class="tudo">

            <div class="topo">
                <div class="header">
                    <div class="container">
                        <div class="navbar">
                            <div class="logo">
                                <a href="../front/graficos.php"><img src="../imgs/tudo/melhor.jpg" alt="" width="100px" heigth="100px"></a>
                            </div>
                            <nav>
                                    <ul id="MenuItems">
                                        <li><a href="../front/graficos.php">Gráficos</a></li>
                                        <li><a href="../front/users_admin.php"><span>Usuários</span></a></li>
                                        <li><a href="../front/prod_admin.php">Produtos</a></li>
                                        <li><a href="../index.php">Utilizar como cliente &#8594;</a></li>
                                    </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internas">
                <!--Conta - Informações-------------------------------------------------------------------------------------------------------->
                <form action="../back/cadastrar_user_adm.php" method="post" class="small-container" name="form1">
                    <h2>Informações da conta</h2>
                    
                    <label>
                        <div class='icon'><i class='fas fa-user'></i></div>
                        <input type='text' name='nome' value='nome' autocomplete='off' class="texto">
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-user'></i></div>
                        <input type='text' name='sobrenome' value='sobrenome' autocomplete='off' class="texto">
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-venus-mars'></i></div>
                        <div class="col-radio">
                                <input type="radio" name="sexo" value="F" class="radio"><p>Feminino</p required> &#160;&#160;&#160;&#160;&#160;
                                <input type="radio" name="sexo" value="M" class="radio"><p>Masculino</p required>
                        </div>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-calendar-alt'></i></div>
                        <input type='text' class="texto" name='data' onKeyPress='MascaraData(form1.data);' maxlength='10' value='data' autocomplete='off'>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-address-card'></i></div>
                        <input type='text' class="texto" name='cpf' onKeyPress='MascaraCPF(form1.cpf);' maxlength='14' value='cpf' autocomplete='off'>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-map-marked-alt'></i></div>
                        <input type='text' class="texto" name='cep' onKeyPress='MascaraCep(form1.cep);' maxlength='10' value='cep' autocomplete='off'>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-mobile'></i></div>
                        <input type='text' class="texto" name='telefone' onKeyPress='MascaraTelefone(form1.telefone);' maxlength='15' value='telefone' autocomplete='off'>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-envelope-open-text'></i></div>
                        <input type='email' class="texto" name='email' value='email' autocomplete='off'> 
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-lock'></i></div>   
                        <input type='password' class="texto" name='senhaForca' id='senhaForca' value='senha' onkeyup='validarSenhaForca()'>
                        <div id='erroSenhaForca' class='forca'></div>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class='fas fa-lock'></i></div>
                        <input type='password' class="texto" name='confirma_senha' value='confirma_senha' autocomplete='off'>
                    </label>

                    <label>
                        <div class='icon'><i class='fas fa-venus-mars'></i></div>
                        <div class="col-radio">
                                <input type="radio" name="adm" value="1" class="radio"><p>Administrador</p required>
                                <input type="radio" name="adm" value="2" class="radio"><p>Cliente</p required>
                        </div>
                    </label>


                    <div class="botoes">
                        <button type="submit">Criar usuário</button>
                        <button><a href="../front/conta.php">Voltar</a></button>
                    </div>  
                </form>   
            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                <div class="footer">
                    <div class="navbar">
                        <section>
                        <ul id="MenuItems">
                                    <li><a href="">Gráficos</a></li>
                                    <li><a href="../front/users_admin.php">Usuários</a></li>
                                    <li><a href="../front/prod_admin.php">Produtos</a></li>
                                    <li><a href="../index.php">Utilizar como cliente &#8594;</a></li>
                                </ul>
                        </section>
                    </div>
                        
                    <div class="footer-col-1">
                        <ul>
                            <li>03 - Ana Júlia,</li>
                            <li>06 - Augusto Creppe,</li>
                            <li>11 - Dayna Caroline,</li>
                            <li>19 - João Gabriel,</li>
                            <li>20 - João Pedro,</li>
                            <li>28 - Maria Isabel</li>
                        </ul>
                    </div>

                    <div class="inicio">
                        <a href="insere_user.php">Voltar ao inicio</a>
                    </div>
                </div>
            </div>                  
        </div>

        <script type="text/javascript" src="../back/login_e_cadastro.js"></script>
    </body>
</html>