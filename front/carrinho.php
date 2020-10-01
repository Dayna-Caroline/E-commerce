<!--Dayna Caroline - N°11 - Criação: 02/09-->
<!--Augusto Creppe - N°06 e Dayna Caroline - N°11 - Atualização: 09/09-->

<!DOCTYPE html>

<?php
    include "../back/conexao.php";
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
                                <div class="preco">Subtotal do produto</div>
                            </div>

                            <?php
                                $sql="SELECT c.id_user, c.id_produto, c.quantidade, c.excluido, p.id_produto, p.produto, p.descricao, p.preco, p.imagem 
                                      FROM carrinho AS c JOIN produto AS p ON c.id_produto = p.id_produto 
                                      WHERE c.id_user = $id_user AND c.excluido = FALSE ORDER BY c.id_produto;";
                                
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);
                                
                                if($qtde > 0)
                                {
                                    $soma_total=0;

                                    for($cont=0; $cont < $qtde; $cont++)
                                    {
                                        $linha=pg_fetch_array($resultado);
                                        $estoque=0;
                                        $id_bckp=$linha['id_produto'];
                                        $qtd_bckp=$linha['quantidade'];

                                        for($cont2=0; $cont2 < $linha['quantidade']; $cont2++)
                                            $soma_total+=$linha['preco'];

                                        echo "
                                        <div class='produtos'>
                                            <div class='produto completa'>
                                                <img src='..".$linha['imagem']."' width='50px'>
                                                <div class='descricao'>
                                                    <br>
                                                    <p>".$linha['produto']."</p>
                                                    <a href='../back/remove_prod_carrinho.php?id_prod=".$linha['id_produto']."'>Remover</a>
                                                </div>
                                            </div>

                                            <div class='qtde'>";

                                                $sql2="SELECT produto.quantidade FROM produto WHERE id_produto=$id_bckp;";
                                                $resultado2 = pg_query($conecta, $sql2);
                                                $qtde2 = pg_num_rows($resultado2);
                                                if($qtde2 > 0)
                                                {
                                                    $linha2=pg_fetch_array($resultado2);
                                                    $estoque=$linha2['quantidade'];
                                                }

                                                echo "
                                                <form action='../back/atualiza_carrinho.php' method='post' class='menos'>
                                                    <input type='hidden' name='id_prod' value='".$id_bckp."'/>
                                                    <input type='hidden' name='qtd_prod' value='".$qtd_bckp."'/>
                                                    <input type='hidden' name='estoque' value='".$estoque."'/>
                                                    <input type='hidden' id='muda' name='muda' value='1'>
                                                    <button type='submit' class='submit'>-</button>
                                                </form>
                                                <a>".$linha['quantidade']."</a>
                                                <form action='../back/atualiza_carrinho.php' method='post' class='mais'>
                                                    <input type='hidden' name='id_prod' value='".$id_bckp."'/>
                                                    <input type='hidden' name='qtd_prod' value='".$qtd_bckp."'/>
                                                    <input type='hidden' name='estoque' value='".$estoque."'/>
                                                    <input type='hidden' id='muda' name='muda' value='2'>
                                                    <button type='submit' class='submit'>+</button>
                                                </form>

                                            </div>

                                            <div class='preco'>
                                                R$ ".($linha['preco']*$linha['quantidade']).",00
                                            </div>
                                        </div>";
                                    }

                                    echo "
                                    <div class='total'>
                                        <div class='preco_compra'>
                                            <h4>Preço Total da Compra: R$ ".$soma_total.",00</h4>
                                        </div>
                                        <div class='botao'>
                                            <a href='./confirma_compra.php'><button>Comprar</button></a>
                                        </div>
                                    </div>";
                                }
                                else
                                {
                                    echo "Não há produtos no carrinho";
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