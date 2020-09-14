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
        <link rel="stylesheet" href="../styles/sobre.css">
    </head>

    <body>
        <div class="tudo">

            <div class="topo">
                <div class="header">
                    <div class="container">
                        <div class="navbar">
                            <div class="logo">
                                <img src="../imgs/index/melhor.jpg" alt="" width="100px" heigth="100px">
                            </div>
                            <nav>
                                <ul id="MenuItems">
                                    <li><a href="">Home</a></li>
                                    <li><a href="./front/produtos.php">Produtos</a></li>
                                    <li><a href=""><span>Sobre</span></a></li>
                                </ul>
                            </nav>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "../front/login_e_cadastro.php";
                                else
                                //echo " LINK DA PAGINA DA CONTA ";
                            ?>
                            
                            "><img src="../imgs/index/conta.png" alt="" width="30px" heigth="30px"></a>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "../front/login_e_cadastro.php";
                                else
                                  echo "../front/carrinho.php";
                            ?>
                            
                            "><img src="../imgs/index/carrinho.png" alt="" width="30px" heigth="30px"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internas">
                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>Emprego</p>
                                    <h2>Ana Júlia Camargo de Freitas</h2>
                                    <small>dayna.caroline@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>Emprego</p>
                                    <h2>Augusto Zanardi Creppe</h2>
                                    <small>augusto.creppe@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>Emprego</p>
                                    <h2>Dayna Caroline Domiciano do Prado</h2>
                                    <small>dayna.caroline@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>Emprego</p>
                                    <h2>João Gabriel Noce Laureano</h2>
                                    <small>dayna.caroline@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>Emprego</p>
                                    <h2>João Pedro Leizico Gutierrez</h2>
                                    <small>dayna.caroline@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>Emprego</p>
                                    <h2>Maria Isabel de Oliveira Pavaneli Agostini</h2>
                                    <small>dayna.caroline@unesp.br</small>
                                </div>
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
                                    <li><a href="../front/produtos.php">Produtos</a></li>
                                    <li><a href="">Sobre</a></li>
                                </ul>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "../front/login_e_cadastro.php";
                                    else
                                    //echo " LINK DA PAGINA DA CONTA ";
                                ?>
                                
                                "><img src="../imgs/index/conta_branco.JPG" alt="" width="30px" heigth="30px"></a>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "../front/login_e_cadastro.php";
                                    else
                                    echo "../front/carrinho.php";
                                ?>
                                
                                "><img src="../imgs/index/carrinho_branco.JPG" alt="" width="30px" heigth="30px"></a>
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
                            <a href="sobre.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>
    </body>
</html>