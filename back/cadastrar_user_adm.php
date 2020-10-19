<!DOCTYPE html>
<?php
    include "conexao.php";
    
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data'];
    $cpf = $_POST['cpf'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $se = $_POST['senhaForca'];
    $confirma_senha = $_POST['confirma_senha'];
    $adm = $_POST['adm'];
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cup&Mug</title>
        <link rel="stylesheet" href="../styles/insere_user.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>

    <body>
        <style>
        div.centro {
            text-align: center;
        }
        </style>
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
        <?php

    if($se != $confirma_senha)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: senhas diferentes!')";
        echo '</script>';
    }
    else if(strlen($data_nascimento) != 10)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: data de nascimento incorreta!(dd/mm/aaaa)')";
        echo '</script>';
    }
    else
    {
        $senha = base64_encode($se);
        if($adm == '1')
        {
            $sql = "INSERT INTO usuario VALUES(DEFAULT, '$nome', '$sobrenome', '$sexo', '$data_nascimento', '$cpf', '$email', '$senha', '$telefone', '$cep', FALSE, NULL, TRUE)";
        }
        else
        {
            $sql = "INSERT INTO usuario VALUES(DEFAULT, '$nome', '$sobrenome', '$sexo', '$data_nascimento', '$cpf', '$email', '$senha', '$telefone', '$cep', FALSE, NULL, FALSE)";
        }
        
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);
        if($linhas > 0)
        {
            echo ' <div class="tudo">
            <br><br><br><br><br><br><br><br><br><br><br><br><div class="centro"><h1><b> Usuário cadastrado com sucesso </b></h1></div>
            <div class="botoes">
                        
                        <br><h2><a href="../front/insere_user.php">Voltar</a></h2>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
        }
        else	
        {
            echo ' <div class="tudo">
            <br><br><br><br><br><br><br><br><br><br><br><br><div class="centro"><h1><b> Usuário não pode ser registrado </b></h1></div> 
            <div class="botoes">
                        
                        <br><h2><a href="../front/insere_user.php">Voltar</a></h2>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
        }
        
    }
?>  
        </div>
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
