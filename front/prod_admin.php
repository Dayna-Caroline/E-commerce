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
    <link rel="stylesheet" href="../styles/prod_admin.css">
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
                    <div class="row row-2">
                            <form class="pesq_text" action="../front/pesq_user.php" method="post">
                                <input type="text" name="pesq" class="text" placeholder="Produto">
                                <button type="submit" class="icon">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>

                            <div class="opcoes">
                                <input type="radio" name="opcao" value="material"> Material
                                <input type="radio" name="opcao" value="tamanho"> Tamanho
                                <input type="number" name="opcao" value="estoque"> Estoque
                            </div>
            
                    </div>


            <div class="small-container">
                        <div class="tabela">
                            <div class="titulos">
                                <div class="produto">Produto</div>
                                <div class="quant">Material</div>
                                <div class="quant">Tamanho</div>
                                <div class="quant">Estoque</div>
                                <div class="preco">Preço</div>
                            </div>

                            <?php
                                $sql="SELECT *FROM produto WHERE excluido='false' ORDER BY id_produto;";
                                
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);
                                
                                if($qtde > 0)
                                {

                                    for($cont=0; $cont < $qtde; $cont++)
                                    {
                                        $linha=pg_fetch_array($resultado);

                                        echo "
                                        <div class='produtos'>
                                            <div class='produto completa'>
                                                <img src='..".$linha['imagem']."' width='50px'>
                                                <div class='descricao'>
                                                    <br>
                                                    <p>".$linha['produto']."</p>
                                                    <a href='../back/remove_prod_carrinho.php?id_prod=".$linha['id_produto']."'>Mais detalhes</a>
                                                </div>
                                            </div>

                                            <div class='quant'>
                                                <span>".$linha['material']."</span>
                                            </div>

                                            <div class='quant'>
                                                <span>".$linha['tamanho']."mL</span>
                                            </div>

                                            <div class='quant'>
                                                <span>".$linha['quantidade']."</span>
                                            </div>

                                            <div class='preco1'>
                                                <span>R$".$linha['preco'].",00</s´pan>
                                            </div>
                                        </div>";
                                    }
                                }
                                else
                                {
                                    echo "<center><br><br><br><br><br><br><br><br><br><br><br><br><h1><div class='tabela'><b> Seu carrinho está vazio </b></div></h1> <br><br><br><br><br><br><br></center>";
                                }

                            ?>
                        </div> 
                    
                </div> 
        </div> 

        <div class="rodape">
            
            
                <div class="footer">
                    <div class="navbar">
                        <section>
                        <ul id="MenuItems">
                                    <li><a href="../front/graficos.php">Vendas</a></li>
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
                        <a href="prod_admin.php">Voltar ao inicio</a>
                    </div>
                </div>
        </div>                  
    </div>
</body>
</html>