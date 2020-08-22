<!--Dayna Caroline Domiciaon do Prado
    Criação: 18/08
    Última alteração: 21/08
 -->
 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empresa</title>
    
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <div class="container">
        <div class="conteudo primeiro-conteudo">
            <div class="primeiro-coluna">
                <h2 class="titulo titulo-primario">Não tem um cadastro?</h2>
                <p class="descricao descricao-primario">Cadastre-se com seus dados pessoais</p>
                <p class="descricao descricao-primario">e aproveite suas compras na Empresa</p>
                <button id="cadastro" class="btn btn-primario">Cadastrar</button>
            </div>  

            <div class="segundo-coluna">
                <h2 class="titulo titulo-segundo">Fazer login</h2>
                <form action="" method="post" class="form">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="senha" placeholder="Senha"> 
                    <a href="" class="esqueceu-senha">Esqueceu sua senha?</a>
                    <button type="submit" class="btn btn-segundo">Entrar</button>  
                </form>             
            </div>
        </div>

        <div class="conteudo segundo-conteudo">
            <div class="primeiro-coluna">
                <h2 class="titulo titulo-primario">Já tem um cadastro?</h2>
                <p class="descricao descricao-primario">Entre com seu email e senha</p>
                <p class="descricao descricao-primario">para fazer suas compras na Empresa</p>
                <button id="login" class="btn btn-primario">Entrar</button>
            </div>

            <div class="segundo-coluna">
                <h2 class="titulo titulo-segundo">Fazer cadastro</h2>
                <form action="" method="post" class="form">
                    <input type="text" name="nome" placeholder="Nome">
                    <input type="text" name="sobrenome" placeholder="Sobrenome">
                    <input type="text" name="sexo" placeholder="Sexo">
                    <input type="tel" name="data_nascimento" placeholder="Data de nascimento">
                    <input type="tel" name="cpf" placeholder="CPF">
                    <input type="tel" name="telefone" placeholder="Telefone">
                    <input type="tel" name="cep" placeholder="CEP">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="senha" placeholder="Senha">
                    <input type="password" name="confima-senha" placeholder="Confirme sua senha">
                    <button type="submit" class="btn btn-segundo">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./back/index.js"></script>
</body>
</html>