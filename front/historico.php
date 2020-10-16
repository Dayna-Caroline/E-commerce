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
    <link rel="stylesheet" href="../styles/historico.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body>
    <div class="tudo">
        <div class="topo">
            <div class="header">
                <div class="container">
                    <div class="navbar">
                        <div class="logo">
                            <a href="../index.php"><img src="../imgs/tudo/melhor.jpg" alt="" width="100px" heigth="100px"></a>
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
                        
                        "><img src="../imgs/tudo/conta.png" alt="" width="30px" heigth="30px"></a>
                        <a href="
                        
                        <?php
                            if($logado ==  null)
                                echo "../front/login_e_cadastro.php";
                            else
                                echo "../front/carrinho.php";
                        ?>
                        
                        "><img src="../imgs/tudo/carrinho.png" alt="" width="30px" heigth="30px"></a>
                   
                        <?php
                                if($adm == true)
                                    echo "<a href=''><img src='../imgs/tudo/config.png' alt='' width='30px' heigth='30px'></a>";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="internas">
        <h1>Histórico de compras</h1>
        <div class="small_container">
            <?php
                $sql = "SELECT * from compra WHERE id_user = $id_user";
                $resultado = pg_query($conecta, $sql);
                $qtde = pg_num_rows($resultado);
                if ($qtde > 0)
                {
                    for($cont=0; $cont < $qtde; $cont++)
                    {
                        $total=0;
                        $linha = pg_fetch_array($resultado);
                        $id_atual = $linha['id_compra'];

                        echo "<div class='tabela'>
                            <div class='data'>Data da Compra: ".date_format(new DateTime($linha['data_compra']), 'd/m/Y')."</div>";

                        $sql2 = "SELECT compra.id_compra, produto.produto, itens.quantidade, produto.preco, produto.imagem 
                                 FROM itens JOIN compra ON itens.id_compra=compra.id_compra
                                 INNER JOIN produto ON itens.id_produto=produto.id_produto
                                 WHERE id_user=$id_user ORDER BY data_compra";
                        $resultado2 = pg_query($conecta, $sql2);
                        $qtde2 = pg_num_rows($resultado2);
                        while($linha2 = pg_fetch_array($resultado2))
                        {
                            if($linha2['id_compra'] == $id_atual)
                            {
                                echo "<div class='info'>
                                        <section class='img'>
                                            <div class='foto'><img src='..".$linha2['imagem']."' width='50px'></div>
                                            <div class='desc'>".$linha2['produto']."</div>
                                        </section> 
                                        <section>".$linha2['quantidade']."x </section>
                                    </div>";
                                $total += $linha2['preco']*$linha2['quantidade'];
                            }
                        }

                        echo "<div class='total'>Total: R$".$total.",00 </div>
                        </div>";
                    }
                }
                else
                {
                    echo "<br><br><br><br><br><br><br><br><br><br><br><br><h1><div class='tabela'><b> Seu histórico está vazio </b></div></h1> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                }
            ?>
        </div>

    </div> 

        <div class="rodape">
            
            
                <div class="footer">
                    <div class="navbar">
                        <section>
                            <ul id="MenuItems">
                                <li><a href="../index.php">Home</a></li>
                                <li><a href="../front/produtos.php">Produtos</a></li>
                                <li><a href="../front/sobre.php">Sobre</a></li>
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
                        <a href="historico.php">Voltar ao inicio</a>
                    </div>
                </div>
        </div>                  
    </div>

    <script type="text/javascript" src="../back/login_e_cadastro.js"></script>
</body>
</html>