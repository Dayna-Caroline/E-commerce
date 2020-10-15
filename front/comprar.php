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
                                                <p>".$linha['descricao']."</p>
                                                <h4>R$".$linha['preco'].",00</h4>";
                                                                                            
                                                if($linha['quantidade'] <= 0)
                                                {
                                                    echo"
                                                    <br><a>PRODUTO ESGOTADO</a>";
                                                }
                                                else
                                                {
                                                    echo "
                                                    <button><a href='../front/login_e_cadastro.php'>Adiconar ao carrinho</a></button>";
                                                }
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
                                                <p>".$linha['descricao']."</p>
                                                <h4>R$".$linha['preco'].",00</h4> <br>";
                                            
                                                if($linha['quantidade'] <= 0)
                                                {
                                                    echo"
                                                    <br><a>PRODUTO ESGOTADO</a>";
                                                }
                                                else
                                                {
                                                    echo "
                                                    <button><a href='../back/add_carrinho.php?id_prod=".$linha['id_produto']."'>Adicionar ao carrinho</a></button>";
                                                }
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
                
                
                
                <!--Outros produtos-------------------------------------------------------------------------------------------------------->
                    <div class="small-container">
                    <h2 class="title">Outros produtos</h2>
                        <div class="row outros">
                            <?php
                                $sql="SELECT * FROM produto WHERE cupormug = '$cupormug' AND id_produto != '$id_prod' AND excluido = FALSE";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);
                                
                                if($qtde > 0){
                                    if($logado == null)
                                    {
                                        for($cont=0; $cont < 4; $cont++)
                                        {
                                            $linha=pg_fetch_array($resultado);
                                            echo "<div class='col-4'>
                                            <a href='comprar.php?id_prod=".$linha['id_produto']."'><img src='..".$linha['imagem']."' alt=''></a>
                                            <h4>".$linha['produto']."</h4>
                                            <p>R$".$linha['preco'].",00</p>";
                                            
                                            if($linha['quantidade'] <= 0)
                                            {
                                                echo"
                                                <br><a>PRODUTO ESGOTADO</a>";
                                            }
                                            else
                                            {
                                                echo "
                                                <button><a href='login_e_cadastro.php'>Adicionar ao carrinho</a></button>";
                                            }
                                            echo "
                                        </div>";
                                        }
                                    }
                                    else
                                    {
                                        for($cont=0; $cont < 4; $cont++)
                                        {
                                            $linha=pg_fetch_array($resultado);
                                            echo "<div class='col-4'>
                                            <a href='comprar.php?id_prod=".$linha['id_produto']."'><img src='..".$linha['imagem']."' alt=''></a>
                                            <h4>".$linha['produto']."</h4>
                                            <p>R$".$linha['preco'].",00</p>";
                                            
                                            if($linha['quantidade'] <= 0)
                                            {
                                                echo"
                                                <br><a>PRODUTO ESGOTADO</a>";
                                            }
                                            else
                                            {
                                                echo "
                                                <button><a href='../back/add_carrinho.php?id_prod=".$linha['id_produto']."'>Adicionar ao carrinho</a></button>";
                                            }
                                            echo "
                                        </div>";
                                        }
                                    }
                                }
                                else{
                                    echo "Não há produtos cadastrados";
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
                            <a href="comprar.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>
    </body>
</html>

<!--<input type='number' name='qtde' placeholder='Quantidade'> <br>-->