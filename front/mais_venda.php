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

    $id_compra = $_GET['id_compra'];
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cup&Mug</title>
    <link rel="stylesheet" href="../styles/users_admin.css">
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
                                    <li><a href="../front/users_admin.php"><span>Usuários</span></a></li>
                                    <li><a href="../front/prod_admin.php">Produtos</a></li>
                                    <li><a href="../index.php">Utilizar como cliente &#8594;</a></li>
                                </ul>
                        </nav>
                    </div>
                </div>
            </div> 
        </div>

        <div class="internas">
                    <div class="small-container">
                        <div class="tabela">
                            <div class="titulos">
                                <div class="produto">Produto</div>
                                <div class="quant">Quantidade</div>
                                <div class="preco">Preço</div>
                            </div>

                            <?php   
                                $sql = "SELECT compra.id_user, produto.produto, itens.quantidade, produto.preco, produto.imagem, usuario.nome, usuario.sobrenome, usuario.cep 
                                FROM compra JOIN itens ON itens.id_compra=compra.id_compra
                                INNER JOIN produto ON itens.id_produto=produto.id_produto
                                INNER JOIN usuario ON compra.id_user=usuario.id_user
                                WHERE compra.id_compra=$id_compra";
                            
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);
                                
                                if($qtde > 0)
                                {
                                    $total=0;

                                    for($cont=0; $cont < $qtde; $cont++)
                                    {
                                        $linha=pg_fetch_array($resultado);
                                        $data = date('d/m/Y',  strtotime($linha['data_compra']));

                                        echo "
                                        <div class='produtos'>
                                            <div class='produto completa'>
                                                <div class='img'><img src=..".$linha['imagem']." alt='' width='50px' heigth='50px'></div>
                                                <div class='descricao'>
                                                    <br>
                                                    <p>".$linha['produto']."</p>
                                                </div>
                                            </div>

                                            <div class='quant'>

                                                <p>".$linha['quantidade']."</p>

                                            </div>

                                            <div class='preco1'>
                                                
                                                <p>".$linha['quantidade']." x R$".$linha['preco'].",00</p>
                                            
                                            </div>
                                        </div>";
                                        $total += $linha['preco']*$linha['quantidade'];

                                    }
                                    echo "<div class='desc'>";
                                    echo "Data da compra: ".$data;
                                    echo "Preco total: R$".$total.",00";
                                    echo "Cliente: ".$linha['nome']." ".$linha['sobrenome'];
                                    echo "CEP: ".$linha['cep']; 
                                    echo "</div>";
                                }
                                else
                                {
                                    echo "<center><br><br><br><br><br><br><br><br><br><br><br><br><h1><div class='tabela'><b> Seu carrinho está vazio </b></div></h1> <br><br><br><br><br><br><br></center>";
                                }
                            ?>
                        </div>  
                    </div>
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
                        <a href="users_admin.php">Voltar ao inicio</a>
                    </div>
                </div>
        </div>                  
    </div>
</body>
</html>