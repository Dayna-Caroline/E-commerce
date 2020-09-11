<!--Dayna Caroline - N°11 - Criação: 02/09-->
<!--Augusto Creppe - N°06 e Dayna Caroline - N°11 - Atualização: 09/09-->

<!DOCTYPE html>

<?php
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
                                <img src="./imgs/index/melhor.jpg" alt="" width="100px" heigth="100px">
                            </div>
                            <nav>
                                <ul id="MenuItems">
                                    <li><a href=""><span>Home</span></a></li>
                                    <li><a href="">Produtos</a></li>
                                    <li><a href="">Sobre</a></li>
                                </ul>
                            </nav>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "./front/login_e_cadastro.php";
                                else
                                //echo " LINK DA PAGINA DA CONTA ";
                            ?>
                            
                            "><img src="./imgs/index/conta.png" alt="" width="30px" heigth="30px"></a>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "./front/login_e_cadastro.php";
                                else
                                  //echo " LINK DA PAGINA DO CARRINHO ";
                            ?>
                            
                            "><img src="./imgs/index/carrinho.png" alt="" width="30px" heigth="30px"></a>
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
                                <p>A Cup&Mug traz pra você copos e canecas lindas e coloridas, adquira o seu!!</p>
                                <a href="" class="btn">Fazer compras &#8594;</a>
                            </div>
                        
                            <div class="col-2">
                                <img src="./imgs/index/header.png" alt="">
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
                                        <img src="./imgs/index/caracteristica1.jpg" alt="">

                                        <div class="caracteristica">
                                            <p>Produtos com uma grande variedade de cores no Cup&Mug!!</p>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-3">
                                    <div class="fig">
                                        <img src="./imgs/index/caracteristica2.jpg" alt="">

                                        <div class="caracteristica">
                                            <p>Frases pensadas com muito cuidado para agradar vocês!!</p>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-3">
                                    <div class="fig">
                                        <img src="./imgs/index/caracteristica3.jpg" alt="">

                                        <div class="caracteristica">
                                            <p>Grande variedade de tamanhos e modelos só na Cup&Mug!!</p>
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
                                    <p>Canecas e copos exclusivos!</p>
                                    <h1>Compre na Cup&Mug</h1>
                                    <small>Frases escritas com carinho, que estão em tendência nos bailes!!</small>
                                    <a href="" class="btn">Comprar &#8594;</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <!--Alguns copos----------------------------------------------------------------------------------------------------->
                    <div class="small-container">
                        <h2 class="title">Alguns copos</h2>

                        <div class="row">
                            <div class="col-4">
                                <a href=""><img src="./imgs/index/copo1.jpg" alt=""></a>
                                <h4>Copo twistter</h4>
                                <p>R$30,00</p>
                            </div>
                                
                            <div class="col-4">
                                <a href=""><img src="./imgs/index/copo2.jpg" alt=""></a>
                                <h4>Copo brilhante</h4>
                                <p>R$30,00</p>
                            </div>
                                
                            <div class="col-4">
                                <a href=""><img src="./imgs/index/copo3.jpg" alt=""></a>
                                <h4>Copo com canudo</h4>
                                <p>R$30,00</p>
                            </div>
                                
                            <div class="col-4">
                                <a href=""><img src="./imgs/index/copo4.jpg" alt=""></a>
                                <h4>Copo long colorido</h4>
                                <p>R$30,00</p>
                            </div>
                        </div>
                    </div>

                <!--Algumas canecas--------------------------------------------------------------------------------------------------->
                    <div class="small-container">
                        <h2 class="title">Algumas canecas</h2>
                        
                        <div class="row">
                            <div class="col-4">
                                <a href=""><img src="./imgs/index/caneca1.jpg" alt=""></a>
                                <h4>Caneca de alumínio</h4>
                                 <p>R$30,00</p>
                            </div>
                                    
                            <div class="col-4">
                                <a href=""><img src="./imgs/index/caneca2.jpg" alt=""></a>
                                <h4>Caneca de porcelana</h4>
                                <p>R$30,00</p>
                            </div>
                                    
                            <div class="col-4">
                                <a href=""><img src="./imgs/index/caneca3.jpg" alt=""></a>
                                <h4>Caneca de Acrílico</h4>
                                <p>R$30,00</p>
                            </div>
                                    
                            <div class="col-4">
                                <a href=""><img src="./imgs/index/caneca4.jpg" alt=""></a>
                                <h4>Caneca Winx</h4>
                                <p>R$30,00</p>
                            </div>
                        </div>
                    </div>

            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                    <div class="footer">
                        <div class="navbar">
                            <section>
                                <ul id="MenuItems">
                                    <li><a href="">Home</a></li>
                                    <li><a href="">Produtos</a></li>
                                    <li><a href="">Sobre</a></li>
                                </ul>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "./front/login_e_cadastro.php";
                                    else
                                    //echo " LINK DA PAGINA DA CONTA ";
                                ?>
                                
                                "><img src="./imgs/index/conta_branco.jpg" alt="" width="30px" heigth="30px"></a>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "./front/login_e_cadastro.php";
                                    else
                                    //echo " LINK DA PAGINA DO CARRINHO ";
                                ?>
                                
                                "><img src="./imgs/index/carrinho_branco.jpg" alt="" width="30px" heigth="30px"></a>
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

                        <a href="./back/logout.php">LOGOUT</a>

                        <div class="inicio">
                            <a href="index.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>
    </body>
</html>