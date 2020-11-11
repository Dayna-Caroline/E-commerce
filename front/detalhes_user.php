<!DOCTYPE html>

<?php
    include "../back/conexao.php";

    $id_usuario = $_GET['id_usuario'];

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
        <link rel="stylesheet" href="../styles/detalhes_user.css">
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
                                        <li><a href="../front/graficos.php">Vendas</a></li>
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
                <form action="../back/exclui_user_admin.php?id_usuario='<?php echo $id_usuario; ?>'" method="post" class="small-container" name="form1">
                    <h2>Detalhes do Usuário</h2>

                            <?php
                                $sql="SELECT * FROM usuario WHERE id_user = '$id_usuario' AND excluido = FALSE";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);

                                if($qtde > 0)
                                {
                                    for($cont=0; $cont < $qtde; $cont++)
                                    {
                                        $linha=pg_fetch_array($resultado);
                                        $sexo = 'F';
                                        if($linha['sexo'] == $sexo)
                                        {
                                            $sexo = 'Feminino';
                                        }
                                        else
                                        {
                                            $sexo = 'Masculino';
                                        }

                                        $usuario = 't';
                                        if($linha['adm'] == $usuario)
                                        {
                                            $usuario = 'Administrador';
                                        }
                                        else
                                        {
                                            $usuario = 'Cliente';
                                        }

                                        $data = date('d/m/Y',  strtotime($linha['data_nascimento']));

                                        $se = $linha['senha'];
                                        $senha = base64_decode($se);

                                        echo "
                                    <label>
                                        <div class='icon'><i class='fas fa-user'></i></div>
                                        <a>".$linha['nome']."</a>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-user'></i></div>
                                        <a>".$linha['sobrenome']."</a>
                                    </label>

                                    <label>
                                        <div class='icon'><i class='fas fa-venus-mars'></i></div>
                                        <a>".$sexo."</a>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-calendar-alt'></i></div>
                                        <a>".$data."</a>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-address-card'></i></div>
                                        <a>".$linha['cpf']."</a>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-map-marked-alt'></i></div>
                                        <a>".$linha['cep']."</a>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-mobile'></i></div>
                                        <a>".$linha['telefone']."</a>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-envelope-open-text'></i></div>
                                        <a>".$linha['email']."</a>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-lock'></i></div>   
                                        <a>********</a>
                                    </label>

                                    <label>
                                        <div class='icon'><i class='fas fa-id-badge'></i></div>
                                        <a>".$usuario."</a>
                                    </label>";
                                    }
                                }
                            ?>

                    <div class="botoes">
                        <button><a href="../front/users_admin.php">Voltar</a></button>
                    </div>  
                </form>   
            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                <div class="footer">
                    <div class="navbar">
                        <section>
                        <ul id="MenuItems">
                                    <li><a href="">Vendas</a></li>
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
                        <a href="alterar_user_admin.php">Voltar ao inicio</a>
                    </div>
                </div>
            </div>                  
        </div>

        <script type="text/javascript" src="../back/login_e_cadastro.js"></script>
    </body>
</html>