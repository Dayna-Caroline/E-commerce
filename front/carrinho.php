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
        <link rel="stylesheet" href="../styles/carrinho.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
                                    <li><a href="../front/sobre.php">Sobre</a></li>
                                </ul>
                            </nav>
                            <a href="../front/conta.php"><img src="../imgs/tudo/conta.png" alt="" width="30px" heigth="30px"></a>
                            <a href="../front/carrinho.php"><img src="../imgs/tudo/carrinho.png" alt="" width="30px" heigth="30px"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internas">
                <!--Produtos-------------------------------------------------------------------------------------------------------->
                    <div class="small-container">
                        <div class="tabela">
                            <div class="titulos">
                                <div class="produto">Produto</div>
                                <div class="quant">Quantidade</div>
                                <div class="preco">Preço</div>
                            </div>

                            <div class="produtos">
                                <div class="produto completa">
                                    <img src="../imgs/tudo/copo1.jpg" alt="" width="50px">
                                    <div class="descricao">
                                    <br>
                                        <p>Copo twistter</p>
                                        <a href="">Remover</a>
                                    </div>
                                </div>
                                <div class="quant">
                                    <input type="number" name="" value="1">
                                </div>
                                <div class="preco">
                                    R$30,00
                                </div>
                            </div>

                            <div class="produtos">
                                <div class="produto completa">
                                    <img src="../imgs/tudo/copo2.jpg" alt="" width="50px">
                                    <div class="descricao">
                                    <br>
                                        <p>Copo twistter</p>
                                        <a href="">Remover</a>
                                    </div>
                                </div>
                                <div class="quant">
                                    <input type="number" name="" value="1">
                                </div>
                                <div class="preco">
                                    R$30,00
                                </div>
                            </div>

                            <div class="produtos">
                                <div class="produto completa">
                                    <img src="../imgs/tudo/copo3.jpg" alt="" width="50px">
                                    <div class="descricao">
                                    <br>
                                        <p>Copo twistter</p>
                                        <a href="">Remover</a>
                                    </div>
                                </div>
                                <div class="quant">
                                    <input type="number" name="" value="1">
                                </div>
                                <div class="preco">
                                    R$30,00
                                </div>
                            </div>

                            <div class="produtos">
                                <div class="produto completa">
                                    <img src="../imgs/tudo/copo4.jpg" alt="" width="50px">
                                    <div class="descricao">
                                    <br>
                                        <p>Copo twistter</p>
                                        <a href="">Remover</a>
                                    </div>
                                </div>
                                <div class="quant">
                                    <input type="number" name="" value="1">
                                </div>
                                <div class="preco">
                                    R$30,00
                                </div>
                            </div>

                            <div class="produtos">
                                <div class="produto completa">
                                    <img src="../imgs/tudo/caneca1.jpg" alt="" width="50px">
                                    <div class="descricao">
                                    <br>
                                        <p>Copo twistter</p>
                                        <a href="">Remover</a>
                                    </div>
                                </div>
                                <div class="quant">
                                    <input type="number" name="" value="1">
                                </div>
                                <div class="preco">
                                    R$30,00
                                </div>
                            </div>

                            <div class="produtos">
                                <div class="produto completa">
                                    <img src="../imgs/tudo/caneca2.JPG" alt="" width="50px">
                                    <div class="descricao">
                                    <br>
                                        <p>Copo twistter</p>
                                        <a href="">Remover</a>
                                    </div>
                                </div>
                                <div class="quant">
                                    <input type="number" name="" value="1">
                                </div>
                                <div class="preco">
                                    R$30,00
                                </div>
                            </div>

                            <div class="total">
                                <div class="preco">
                                    <h4>Preço Total: R$180,00</h4>
                                </div>
                                <div class="botao">
                                    <button>Finalizar compra</button>
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
                                    <li><a href="../index.php">Home</a></li>
                                    <li><a href="../front/produtos.php">Produtos</a></li>
                                    <li><a href="../front/sobre.php">Sobre</a></li>
                                </ul>
                                <a href="../front/conta.php"><img src="../imgs/tudo/conta_branco.JPG" alt="" width="30px" heigth="30px"></a>
                                <a href="../front/carrinho.php"><img src="../imgs/tudo/carrinho_branco.JPG" alt="" width="30px" heigth="30px"></a>
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
                            <a href="carrinho.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>
    </body>
</html>