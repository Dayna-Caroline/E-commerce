<!--Dayna Caroline - N°11 - Criação: 02/09-->
<!--Augusto Creppe - N°06 e Dayna Caroline - N°11 - Atualização: 09/09-->

<!DOCTYPE html>

<?php
    include "./back/conexao.php";
    
    $logado = null;

    session_start();
    
    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $adm = $_SESSION['adm'];
        $nome = $_SESSION['nome']; 
        $sexo = $_SESSION['sexo'];
    }
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cup&Mug</title>
        <link rel="stylesheet" href="./styles/index.css">
    </head>

    <body>
        <div class="tudo">

            <div class="topo">
                <div class="header">
                    <div class="container">
                        <div class="navbar">
                            <div class="logo">
                                <img src="./imgs/tudo/melhor.jpg" alt="" width="100px" heigth="100px">
                            </div>
                            <nav>
                                <ul id="MenuItems">
                                    <li><a href=""><span>Home</span></a></li>
                                    <li><a href="./front/produtos.php">Produtos</a></li>
                                    <li><a href="./front/sobre.php">Sobre</a></li>
                                </ul>
                            </nav>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "./front/login_e_cadastro.php";
                                else
                                    echo "./front/conta.php";
                            ?>
                            
                            "><img src="./imgs/tudo/conta.png" alt="" width="30px" heigth="30px"></a>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "./front/login_e_cadastro.php";
                                else
                                  echo "./front/carrinho.php";
                            ?>
                            
                            "><img src="./imgs/tudo/carrinho.png" alt="" width="30px" heigth="30px"></a>

                            <?php
                                if($adm == true)
                                    echo "<a href='./front/graficos.php'><img src='./imgs/tudo/config.png' alt='' width='30px' heigth='30px'></a>";
                            ?>
                        </div>
                        
                        <div class="row">
                            <div class="col-2">
                                <h1>
                                 
                                <?php
                                    echo "Bem vind";
                                    
                                    if($logado != NULL)
                                    {
                                        if($sexo == 'M')
                                            echo "o, ".$nome."!";
                                        if($sexo == 'F')
                                        echo "a, ".$nome."!";
                                    }
                                    else
                                    {
                                        echo "o!";
                                    }
                                ?>
                                
                                <br>Compre na Cup&Mug!!</h1>
                                <p>A Cup&Mug traz copos e canecas lindos e coloridos para você, adquira já o seu!</p>
                                <a href="./front/produtos.php" class="btn">Fazer compras &#8594;</a>
                            </div>
                        
                            <div class="col-2">
                                <img src="./imgs/tudo/header.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internas">
                
                <!--Fotos e caracteríticas dos produtos------------------------------------------------------------------------------->
                    <div class="categories">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-3">
                                    <div class="fig">
                                        <img src="./imgs/tudo/caracteristica1.jpg" alt="">

                                        <div class="caracteristica">
                                            <p>Produtos com grande variedade de cores na Cup&Mug!</p>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-3">
                                    <div class="fig">
                                        <img src="./imgs/tudo/caracteristica2.jpg" alt="">

                                        <div class="caracteristica">
                                            <p>Frases pensadas com muito cuidado para agradar vocês!</p>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-3">
                                    <div class="fig">
                                        <img src="./imgs/tudo/caracteristica3.jpg" alt="">

                                        <div class="caracteristica">
                                            <p>Grande variedade de tamanhos e modelos só na Cup&Mug!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!--Vídeo-------------------------------------------------------------------------------------------------------------->
                    <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <iframe class="offer-img" src="https://www.youtube.com/embed/VRYVe8Ar6g4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                    
                                <div class="col-2">
                                    <p>Copos e canecas exclusivos!</p>
                                    <h1>Compre na Cup&Mug</h1>
                                    <small>Frases escritas com carinho que são a tendência dos bailes!</small>
                                    <a href="./front/produtos.php" class="btn">Comprar &#8594;</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <!--Alguns copos----------------------------------------------------------------------------------------------------->
                    <div class="small-container">
                        <h2 class="title">Alguns de nossos copos</h2>

                        <div class="row">
                            <?php
                                $sql="SELECT * FROM produto WHERE cupormug = '1' AND excluido = FALSE";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);
                                if($qtde > 0){
                                    if($logado == null){
                                        for($cont=0; $cont < 4; $cont++){
                                            $linha=pg_fetch_array($resultado);
                                            echo "<div class='col-4'>
                                            <a href='./front/comprar.php?id_prod=".$linha['id_produto']."'><img src='.".$linha['imagem']."' alt=''></a>
                                            <h4>".$linha['produto']."</h4>
                                            <p>R$".$linha['preco'].",00</p>";
                                            
                                            if($linha['quantidade'] <= 0)
                                            {
                                                echo"
                                                <br><a>PRODUTO ESGOTADO</a>";
                                            }
                                            else
                                            {
                                                echo "
                                                <button><a href='./front/login_e_cadastro.php'>Adicionar ao carrinho</a></button>";
                                            }
                                            echo "
                                        </div>";
                                        }
                                    }
                                    else{
                                        for($cont=0; $cont < 4; $cont++){
                                            $linha=pg_fetch_array($resultado);
                                            echo "<div class='col-4'>
                                            <a href='./front/comprar.php?id_prod=".$linha['id_produto']."'><img src='.".$linha['imagem']."' alt=''></a>
                                            <h4>".$linha['produto']."</h4>
                                            <p>R$".$linha['preco'].",00</p>";
                                            
                                            if($linha['quantidade'] <= 0)
                                            {
                                                echo"
                                                <br><a>PRODUTO ESGOTADO</a>";
                                            }
                                            else
                                            {
                                                echo "
                                                <button><a href='./back/add_carrinho.php?id_prod=".$linha['id_produto']."'>Adicionar ao carrinho</a></button>";
                                            }
                                            echo "
                                        </div>";
                                        }
                                    }
                                }
                                else{
                                    echo "Não há produtos cadastrados";
                                }
                            ?>
                        </div>

                <!--Algumas canecas--------------------------------------------------------------------------------------------------->
                    <div class="small-container">
                        <h2 class="title">Algumas de nossas canecas</h2>
                        
                        <div class="row">
                            
                            <?php
                                $sql="SELECT * FROM produto WHERE cupormug = '2' AND excluido = FALSE";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);
                                if($qtde > 0){
                                    if($logado == null){
                                        for($cont=0; $cont < 4; $cont++){
                                            $linha=pg_fetch_array($resultado);
                                            echo "<div class='col-4'>
                                            <a href='./front/comprar.php?id_prod=".$linha['id_produto']."'><img src='.".$linha['imagem']."' alt=''></a>
                                            <h4>".$linha['produto']."</h4>
                                            <p>R$".$linha['preco'].",00</p>";
                                            
                                            if($linha['quantidade'] <= 0)
                                            {
                                                echo"
                                                <br><a>PRODUTO ESGOTADO</a>";
                                            }
                                            else
                                            {
                                                echo "
                                                <button><a href='./front/login_e_cadastro.php'>Adicionar ao carrinho</a></button>";
                                            }
                                            echo "
                                        </div>";
                                        }
                                    }
                                    else{
                                        for($cont=0; $cont < 4; $cont++){
                                            $linha=pg_fetch_array($resultado);
                                            echo "<div class='col-4'>
                                            <a href='./front/comprar.php?id_prod=".$linha['id_produto']."'><img src='.".$linha['imagem']."' alt=''></a>
                                            <h4>".$linha['produto']."</h4>
                                            <p>R$".$linha['preco'].",00</p>";
                                            
                                            if($linha['quantidade'] <= 0)
                                            {
                                                echo"
                                                <br><a>PRODUTO ESGOTADO</a>";
                                            }
                                            else
                                            {
                                                echo "
                                                <button><a href='./back/add_carrinho.php?id_prod=".$linha['id_produto']."'>Adicionar ao carrinho</a></button>";
                                            }
                                            echo "
                                        </div>";
                                        }
                                    }
                                }
                                else{
                                    echo "Não há produtos cadastrados";
                                }
                            ?>

                        </div>
                    </div>

            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                    <div class="footer">
                        <div class="navbar">
                            <section>
                                <ul id="MenuItems">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="./front/produtos.php">Produtos</a></li>
                                    <li><a href="./front/sobre.php">Sobre</a></li>
                                </ul>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "./front/login_e_cadastro.php";
                                    else
                                        echo "./front/conta.php";
                                ?>
                                
                                "><img src="./imgs/tudo/conta_branco.JPG" alt="" width="30px" heigth="30px"></a>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "./front/login_e_cadastro.php";
                                    else
                                    echo "./front/carrinho.php";
                                ?>
                                
                                "><img src="./imgs/tudo/carrinho_branco.JPG" alt="" width="30px" heigth="30px"></a>
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
                            <a href="index.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>
    </body>
</html>