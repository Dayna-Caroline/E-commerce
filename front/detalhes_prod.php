<!--Dayna Caroline - N°11 - Criação: 02/09-->
<!--Augusto Creppe - N°06 e Dayna Caroline - N°11 - Atualização: 09/09-->

<!DOCTYPE html>

<?php
    include "../back/conexao.php";
    $id_prod = $_GET["id_prod"];

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
        <link rel="stylesheet" href="../styles/detalhes_prod.css">
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
                                    <li><a href="../front/prod_admin.php">Produtos</a></li>
                                    <li><a href="../index.php">Utilizar como cliente &#8594;</a></li>
                                </ul>
                        </nav>
                    </div>
                </div>
            </div> 
        </div>

            <div class="internas">
                <!--Detalhes do produto----------------------------------------------------------------------------------------------------->
                    
                    <div class="small-container">
                        <div class="row">
                            <?php
                                $sql="SELECT * FROM produto WHERE id_produto = '$id_prod' AND excluido = FALSE";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);

                                if($qtde > 0)
                                {
                                    if($logado == null){
                                        for($cont=0; $cont < $qtde; $cont++)
                                        {
                                            $linha=pg_fetch_array($resultado);
                                            $cupormug=$linha['cupormug'];
                                            echo "<div class='col-2'>
                                            <img src='..".$linha['imagem']."' width='100%'>
                                        </div>
                                        <div class='col-2'>
                                            <div class='descricao'>
                                                <h1>".$linha['produto']."</h1>
                                                <p>".$linha['descricao']."</p>";
                                                                                                      
                                                if($linha['quantidade'] <= 0)
                                                {
                                                    echo"
                                                    <br><a>PRODUTO ESGOTADO</a>";
                                                }
                                                else
                                                {
                                                    echo "<br><a>Estoque: ".$linha['quantidade']."</a>";
                                                }
                                                echo "<h4>R$".$linha['preco'].",00</h4>";
                                                echo "
                                                <br><button class='btn_voltar'><a href='./produtos.php'>Voltar</a></button>
                                            </div>
                                        </div>";
                                        }
                                    }
                                    else{
                                        for($cont=0; $cont < $qtde; $cont++)
                                        {
                                            $linha=pg_fetch_array($resultado);
                                            $cupormug=$linha['cupormug'];
                                            echo "<div class='col-2'>
                                            <img src='..".$linha['imagem']."' width='100%'>
                                        </div>
                                        <div class='col-2'>
                                            <div class='descricao'>
                                                <h1>".$linha['produto']."</h1>
                                                <p>".$linha['descricao']."</p>";
                                                                                                    
                                                if($linha['quantidade'] <= 0)
                                                {
                                                    echo"
                                                    <br><a>PRODUTO ESGOTADO</a>";
                                                }
                                                else
                                                {
                                                    echo "<br><h4>Estoque: ".$linha['quantidade']."</h4>";
                                                }
                                                echo "<h4>R$".$linha['preco'].",00</h4>";
                                                echo "
                                                <br><button class='btn_voltar'><a href='./produtos.php'>Voltar</a></button>
                                            </div>
                                        </div>";
                                        }
                                    }
                                }
                                else{
                                    echo "Erro ao encontrar o produto";
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

<!--<input type='number' name='qtde' placeholder='Quantidade'> <br>-->