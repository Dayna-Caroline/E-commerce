<!--Dayna Caroline - N°11 - Criação: 04/09-->
<!--Augusto Creppe - N°06 e Dayna Caroline - N°11 - Atualização: 09/09-->


<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <title>Cup&Mug</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login_e_cadastro.css"> 
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>

    <?php
        if(isset($_GET['success'])) 
        {
            if($_GET['success'] == 'false') 
            {
                echo '<script language="javascript">';
                echo "alert('Email ou senha inválidos! Tente novamente...')";
                echo '</script>';
            }
        }
    ?>

    <body>
        <div class="tudo">
            <div class="cont">
                <div class="form sign-in">
                    <form action="../back/login.php" method="post" class="login">
                        <h2>Login</h2>
                        <label>
                            <div class="icon"><i class="fas fa-envelope-open-text"></i></div>
                            <input type="email" name="email" placeholder="Email" autocomplete="off">
                        </label>
                    
                        <label>
                            <div class="icon"><i class="fas fa-lock"></i></div>
                            <input type="password" name="senha" placeholder="Senha" autocomplete="off">
                        </label>
                        <a href="esquece_senha.php"><p class="forgot-pass">Esqueceu a senha?</p></a>
                        <button class="submit" type="submit" >Entrar</button>
                    </form>
                </div>

                <div class="sub-cont">
                    <div class="img">
                        <div class="img-text m-up">
                            <h2>É novo aqui?</h2>
                            <p>Faça o cadastro e seja nosso cliente!</p>
                        </div>
                
                        <div class="img-text m-in">
                            <h2>Já é cliente?</h2>
                            <p>Faça login, para fazer suas compras!</p>
                        </div>
                
                    <div class="img-btn">
                        <span class="m-up">Cadastro</span>
                        <span class="m-in">Login</span>
                    </div>
                </div>

                <div class="form sign-up">
                    <h2>Cadastro</h2>
                    <form action="../back/cadastrar_user.php" name="form1" method="post">
                        <label>
                            <div class="icon"><i class="fas fa-user"></i></div>
                            <input type="text" name="nome" placeholder="Nome" autocomplete="off">
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-user"></i></div>
                            <input type="text" name="sobrenome" placeholder="Sobrenome" autocomplete="off">
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-venus-mars"></i></div>
                            <span>Sexo</span>
                            <div class="col-sexo">
                                <input type="radio" name="sexo" value="F"><p>Feminino</p>
                                <input type="radio" name="sexo" value="M"><p>Masculino</p>
                            </div>
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                            <input type="text" name="data" onKeyPress="MascaraData(form1.data);" maxlength="10" placeholder="Data de Nascimento" autocomplete="off">
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-address-card"></i></div>
                            <input type="text" name="cpf" onKeyPress="MascaraCPF(form1.cpf);" maxlength="14" placeholder="CPF" autocomplete="off">
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-map-marked-alt"></i></div>
                            <input type="text" name="cep" onKeyPress="MascaraCep(form1.cep);" maxlength="10" placeholder="CEP" autocomplete="off">
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-mobile"></i></div>
                            <input type="text" name="telefone" onKeyPress="MascaraTelefone(form1.telefone);" maxlength="14" placeholder="Telefone" autocomplete="off">
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-envelope-open-text"></i></div>
                            <input type="email" name="email" placeholder="Email" autocomplete="off"> 
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-lock"></i></div>   
                            <input type="password" name="senhaForca" id="senhaForca" placeholder="Senha" onkeyup="validarSenhaForca()">
                            <div id="erroSenhaForca" class="forca"></div>
                        </label>
                        
                        <label>
                            <div class="icon"><i class="fas fa-lock"></i></div>
                            <input type="password" name="confirma_senha" placeholder="Confirme sua senha" autocomplete="off">
                        </label>
                        
                        <button type="submit" class="submit">Cadastrar</button>
                    </form>
                </div>
            </div>
    
            <script type="text/javascript" src="../back/login_e_cadastro.js"></script>
        </div>
    </body>
</html>