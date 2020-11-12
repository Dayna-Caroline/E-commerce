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
        <link rel="stylesheet" href="../styles/altera_prod.css">
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
                <form action="../back/alt_produto.php?id=<?php echo $id; ?>" method="post" class="small-container exclusao" name="form1">
                    <h2>Alteração de produtos</h2>

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
                                            <div class='icon'><i class='fas fa-pencil-alt'></i></div>
                                            <input type='text' name='produto' value='".$linha['produto']."' class='texto'>
                                        </label>
                                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-align-justify'></i></div>
                                            <input type='text' name='descricao' value='".$linha['descricao']."' class='texto'>
                                        </label>
                                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-beer'></i></div>
                                            <div class='col-radio'>
                                                    <input type='radio' name='cupormug' value='1' class='radio' "; if($linha['cupormug'] == 1) echo"checked"; echo "><p>Copo</p > &#160;&#160;&#160;&#160;&#160;
                                                    <input type='radio' name='cupormug' value='2' class='radio' "; if($linha['cupormug'] == 2) echo"checked"; echo "><p>Caneca</p >
                                            </div>
                                        </label>
                                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-pen-fancy'></i></div>
                                            <input type='text' class='texto' name='material' value='".$linha['material']."'>
                                        </label>
                                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-palette'></i></div>
                                            <input type='text' class='texto' name='cor' value='".$linha['cor']."'>
                                        </label>
                                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-ruler'></i></div>
                                            <input type='number' class='texto' name='tamanho' value='".$linha['tamanho']."'>
                                        </label>
                                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-images'></i></div>
                                            <input type='text' class='texto' name='imagem' value='".$linha['imagem']."'> 
                                        </label>
                                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-clipboard-list'></i></div>
                                            <input type='number' class='texto' name='quantidade' value='".$linha['quantidade']."'> 
                                        </label>
                                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-dollar-sign'></i></div>
                                            <input type='number' class='texto' name='preco' value='".$linha['preco']."'>
                                        </label>";
                                    }
                                }
                            ?>

                    <div class="botoes">
                        <button type="submit">Alterar</button>
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