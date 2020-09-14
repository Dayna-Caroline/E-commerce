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
        <link rel="stylesheet" href="../styles/comprar.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
                                    <li><a href="../index.php">Home</a></li>
                                    <li><a href="../front/produtos.php">Produtos</a></li>
                                    <li><a href="../front/sobre.php">Sobre</a></li>
                                </ul>
                            </nav>
                            <a href="
                            
                            <?php
                                if($logado ==  null)
                                    echo "../front/login_e_cadastro.php";
                                else
                                    echo "../front/conta.php";
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
                <!--Detalhes do produto----------------------------------------------------------------------------------------------------->
                    
                    <div class="small-container">
                        <div class="row">
                            <div class="col-2">
                                <img src="../imgs/index/copo1.jpg" width="100%">
                            </div>
                            <div class="col-2">
                                <div class="descricao">
                                    <h1>Copo twistter</h1>
                                    <p>Descrição.................</p>
                                    <h4>R$30,00</h4>
                                    <input type="number" name="" placeholder="Quantidade"> <br>
                                    <button><a href="
                                        <?php
                                            if($logado ==  null)
                                                echo "../front/login_e_cadastro.php";
                                            else
                                                //echo "LINK PARA A COMPRA";
                                        ?>
                                    ">Comprar</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                
                
                <!--Outros produtos-------------------------------------------------------------------------------------------------------->
                    <div class="small-container">
                    <h2 class="title">Outros produtos</h2>
                        <div class="row outros">
                            <div class="col-4">
                                <a href="../front/comprar.php"><img src="../imgs/index/caneca1.jpg" alt=""></a>
                                <h4>Copo twistter</h4>
                                <p>R$30,00</p>
                                <button><a href="
                                        <?php
                                            if($logado ==  null)
                                                echo "../front/login_e_cadastro.php";
                                            else
                                                //echo "LINK PARA O CADASTRO NO CARRINHO";
                                        ?>
                                    ">Adicionar ao carrinho</a></button>
                            </div>
                                
                            <div class="col-4">
                                <a href="../front/comprar.php"><img src="../imgs/index/copo2.jpg" alt=""></a>
                                <h4>Copo brilhante</h4>
                                <p>R$30,00</p>
                                <button><a href="
                                        <?php
                                            if($logado ==  null)
                                                echo "../front/login_e_cadastro.php";
                                            else
                                                //echo "LINK PARA O CADASTRO NO CARRINHO";
                                        ?>
                                    ">Adicionar ao carrinho</a></button>
                            </div>
                                
                            <div class="col-4">
                                <a href="../front/comprar.php"><img src="../imgs/index/copo3.jpg" alt=""></a>
                                <h4>Copo com canudo</h4>
                                <p>R$30,00</p>
                                <button><a href="
                                        <?php
                                            if($logado ==  null)
                                                echo "../front/login_e_cadastro.php";
                                            else
                                                //echo "LINK PARA O CADASTRO NO CARRINHO";
                                        ?>
                                    ">Adicionar ao carrinho</a></button>
                            </div>
                                
                            <div class="col-4">
                                <a href="../front/comprar.php"><img src="../imgs/index/copo4.jpg" alt=""></a>
                                <h4>Copo long colorido</h4>
                                <p>R$30,00</p>
                                <button><a href="
                                        <?php
                                            if($logado ==  null)
                                                echo "../front/login_e_cadastro.php";
                                            else
                                                //echo "LINK PARA O CADASTRO NO CARRINHO";
                                        ?>
                                    ">Adicionar ao carrinho</a></button>
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
                                    <li><a href="../index.php">Home</a></li>
                                    <li><a href="../front/podutos.php">Produtos</a></li>
                                    <li><a href="../front/sobre.php">Sobre</a></li>
                                </ul>
                                <a href="
                                
                                <?php
                                    if($logado ==  null)
                                        echo "../front/login_e_cadastro.php";
                                    else
                                        echo "../front/conta.php";
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
                            <a href="comprar.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>
    </body>
</html>