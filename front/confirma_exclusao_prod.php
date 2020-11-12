<!DOCTYPE html>

<?php
    include "../back/conexao.php";

    $id = $_GET['id'];

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
                                        <li><a href="../front/users_admin.php">Usuários</a></li>
                                        <li><a href="../front/prod_admin.php"><span>Produtos</span></a></li>
                                        <li><a href="../index.php">Utilizar como cliente &#8594;</a></li>
                                    </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internas">
                <!--Conta - Informações-------------------------------------------------------------------------------------------------------->
                <form action="../back/exclui_prod_admin.php?id_usuario=<?php echo $id; ?>" method="post" class="small-container exclusao" name="form1">
                    <h2>Deseja excluir este produto?</h2>

                            <?php
                                $sql="SELECT * FROM produto WHERE id_produto = '$id' AND excluido = FALSE";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);

                                if($qtde > 0)
                                {
                                    for($cont=0; $cont < $qtde; $cont++)
                                    {
                                        $linha=pg_fetch_array($resultado);
                                        

                                        echo "
                                                <label>
                                                    <div class='icon'><i class='fas fa-user'></i></div>
                                                    <a>".$linha['produto']."</a>
                                                </label>
                                                
                                                <label>
                                                    <div class='icon'><i class='fas fa-user'></i></div>
                                                    <a>".$linha['material']."</a>
                                                </label>
                                               
                                                <label>
                                                    <div class='icon'><i class='fas fa-address-card'></i></div>
                                                    <a>".$linha['cor']."</a>
                                                </label>
                                                
                                                <label>
                                                    <div class='icon'><i class='fas fa-map-marked-alt'></i></div>
                                                    <a>".$linha['tamanho']."mL</a>
                                                </label>

                                                <label>
                                                    <div class='icon'><i class='fas fa-map-marked-alt'></i></div>
                                                    <a>".$linha['quantidade']."</a>
                                                </label>
                                                
                                                <label>
                                                    <div class='icon'><i class='fas fa-mobile'></i></div>
                                                    <a>R$".$linha['preco'].",00</a>
                                                </label>";
                                    }
                                }
                            ?>

                    <div class="botoes">
                        <button type="submit">Deletar</button>
                        <button><a href="../front/prod_admin.php">Voltar</a></button>
                    </div>  
                </form>   
            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                <div class="footer">
                    <div class="navbar">
                        <section>
                        <ul id="MenuItems">
                                    <li><a href="graficos.php">Gráficos</a></li>
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