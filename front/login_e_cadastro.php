<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cup&Mug</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/login_e_cadastro.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600;700&display=swap" rel="stylesheet">    
</head>

<body>
  <div class="cont">
        <div class="form sign-in">
            <form action="" method="post" class="login">
                <h2>Login</h2>
                <label>
                    <span>Email</span>
                    <input type="email" name="email">
                </label>
                <label>
                    <span>Senha</span>
                    <input type="password" name="senha">
                </label>
                <p class="forgot-pass">Esqueceu a senha?</p>
                <button class="submit" type="button">Entrar</button>
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
                <label>
                    <input type="text" name="nome" placeholder="Nome">
                </label>
                <label>
                    <input type="text" name="sobrenome" placeholder="Sobrenome">
                </label>
                <label>
                    <span>Sexo</span>
                    <div class="col-sexo">
                        <input type="radio" name="feminino"><p>Feminino</p>
                        <input type="radio" name="masculino"><p>Masculino</p>
                    </div>
                </label>
                <label>
                    <input type="text" name="data_nascimento" placeholder="Data de nascimento">
                </label>
                <label>
                    <input type="number" name="cpf" placeholder="CPF">
                </label>
                <label>
                    <input type="number" name="cep" placeholder="CEP">
                </label>
                <label>
                    <input type="number" name="telefone" placeholder="Telefone">
                </label>
                <label>
                    <input type="email" name="email" placeholder="Email"> 
                </label>
                <label>
                    <input type="password" name="senha" placeholder="Senha">
                </label>
                <label>
                    <input type="password" name="confirma_senha" placeholder="Confirme sua senha">
                </label>
                <button type="button" class="submit">Cadastrar</button>
            </div>
        </div>
  </div>
<script type="text/javascript" src="../back/login_e_cadastro.js"></script>
</body>
</html>