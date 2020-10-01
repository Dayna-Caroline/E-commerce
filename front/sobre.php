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
                                <a href="../index.php"><img src="../imgs/tudo/melhor.JPG" alt="" width="100px" heigth="100px"></a>
                            </div>
                            <nav>
                                <ul id="MenuItems">
                                    <li><a href="../index.php">Home</a></li>
                                    <li><a href="../front/produtos.php">Produtos</a></li>
                                    <li><a href=""><span>Sobre</span></a></li>
                                </ul>
                            </nav>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "../front/login_e_cadastro.php";
                                else
                                    echo "../front/conta.php";
                            ?>
                            
                            "><img src="../imgs/tudo/conta.png" alt="" width="30px" heigth="30px"></a>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "../front/login_e_cadastro.php";
                                else
                                  echo "../front/carrinho.php";
                            ?>
                            
                            "><img src="../imgs/tudo/carrinho.png" alt="" width="30px" heigth="30px"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internas">

            <br><br><br>
            <center>
                <h1>Grupo 06 - Cup&Mug</h1>
            </center>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../imgs/integrantes/ana.jpeg" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>N° 03</p>
                                    <h2>Ana Júlia Camargo de Freitas</h2>
                                    <small>aj.freitas@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../imgs/integrantes/guto.jpeg" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>N° 06</p>
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
                                    <img src="../imgs/integrantes/dayna.jpeg" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>N° 11</p>    
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
                                    <img src="../imgs/integrantes/joao.jpeg" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>N° 19</p>
                                    <h2>João Gabriel Noce Laureano</h2>
                                    <small>joao.laureano@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../imgs/integrantes/guti.jpeg" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>N° 20</p>
                                    <h2>João Pedro Leizico Gutierrez</h2>
                                    <small>joao.gutierrez@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="offer">
                        <div class="small-container">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../imgs/integrantes/mabel.jpeg" alt="">
                                </div>
                                    
                                <div class="col-2">
                                    <p>N° 28</p>
                                    <h2>Maria Isabel de Oliveira Pavaneli Agostini</h2>
                                    <small>mi.agostini@unesp.br</small>
                                </div>
                            </div>
                        </div>
                </div>

                
                <center>
                    <h1>Professores</h1>
                </center>

                <div class="offer">
                        <div class="small-container">
                            <br><br>
                            <div class="linha-3">
                                <p>Gestão de Negócios</p>
                                <h2>Jovita Mercedes Hojas Baenas</h2>
                                <small>jovita.baenas@unesp.br</small>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="linha-3">
                                <p>Aplicativos</p>
                                <h2>Rodrigo Ferreira de Carvalho</h2>
                                <small>rodrigo.carvalho@unesp.br</small>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="linha-3">
                                <p>PHP e Banco de Dados</p>
                                <h2>Vitor José Del Gaudio Simeão</h2>
                                <small>vitor.simeao@unesp.br</small>
                            </div>
                            <br><br>
                        </div>
                </div>

            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                    <div class="footer">
                        <div class="navbar">
                            <section>
                                <ul id="MenuItems">
                                    <li><a href="../index.php">Home</a></li>
                                    <li><a href="../front/produtos.php">Produtos</a></li>
                                    <li><a href="">Sobre</a></li>
                                </ul>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "../front/login_e_cadastro.php";
                                    else
                                        echo "../front/conta.php";
                                ?>
                                
                                "><img src="../imgs/tudo/conta_branco.JPG" alt="" width="30px" heigth="30px"></a>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "../front/login_e_cadastro.php";
                                    else
                                    echo "../front/carrinho.php";
                                ?>
                                
                                "><img src="../imgs/tudo/carrinho_branco.JPG" alt="" width="30px" heigth="30px"></a>
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