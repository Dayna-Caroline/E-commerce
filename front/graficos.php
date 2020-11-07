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
    }

    //Padrão String Produtos--------------------------------------------------------------------------------
    $sql = "SELECT produto FROM produto";
    $resultado = pg_query($conecta, $sql);
    $qtde = pg_num_rows($resultado);
    $sprod=array();
    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=pg_fetch_array($resultado);
            $produto = $linha['produto'];
            $sprod[$cont] = $produto;
        }
    }

    $ind_prod = count($sprod); 
    //------------------------------------------------------------------------------------------------------

    $sql3 = "SELECT itens.id_produto, itens.quantidade, produto.produto
    FROM itens JOIN produto ON itens.id_produto=produto.id_produto
    ORDER BY itens.id_produto";
    $resultado3 = pg_query($conecta, $sql3);
    $qtde3 = pg_num_rows($resultado3);
    $squant3=array();
    $spocentagem3=array();
    $qtotal3=0;

    if($qtde3 > 0)
    {
        for($cont3=0; $cont3 < $qtde3; $cont3++)
        {
            $linha3=pg_fetch_array($resultado3);
            $id_produto3 = $linha3['id_produto'];
            $quantidade3 = $linha3['quantidade'];
            $squant3[$id_produto3] = $quantidade3;
            $qtotal3 += $quantidade3; 
        }
    }
    
    for($x3=0; $x3 < $ind_prod; $x3++){
        if(empty($squant3[$x3])){
            $squant3[$x3] = 0;
            $spocentagem3[$x3] = '0%';
        }
        else{
            $por3 = ($squant3[$x3] * 100)/$qtotal3;
            $spocentagem3[$x3] = $por3 . '%';
        }
    }
    ksort($squant3); 
    ksort($sporcentagem3);
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cup&Mug</title>
        <link rel="stylesheet" href="../styles/graficos.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Produtos', 'Vendas'],
            
            for(var x = 0; x < <?php$ind_prod?>; x++){
                ['<?php$sprod?>[x]', '<?php$sporcentagem3?>[x]'],
            }
            
            ]);

            var options = {
            title: 'My Daily Activities'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
        </script>
    </head>

    <body>
        <div class="tudo">

            <div class="topo">
                <div class="header">
                    <div class="container">
                        <div class="navbar">
                            <div class="logo">
                                <img src="../imgs/tudo/melhor.jpg" alt="" width="100px" heigth="100px">
                            </div>
                            <nav>
                                <ul id="MenuItems">
                                    <li><a href=""><span>Vendas</span></a></li>
                                    <li><a href="../front/users_admin.php">Usuários</a></li>
                                    <li><a href="../front/prod_admin.php">Produtos</a></li>
                                    <li><a href="../index.php">Utilizar como cliente &#8594;</a></li>
                                </ul>
                            </nav>
                        </div>
                        
                        <div class="row">
                            <div class="col-2">
                                <h1>
                                 
                                <?php
                                    echo "Bem vind";
                                    
                                    if($logado != NULL)
                                    {
                                        if($sexo == 'M')
                                            echo "o, ".$nome."!";
                                        if($sexo == 'F')
                                        echo "a, ".$nome."!";
                                    }
                                    else
                                    {
                                        echo "o!";
                                    }
                                ?>
                                
                                <br>Consulte as vendas.</h1>
                                <p>Aqui você pode ver gráficos e tabelas que mostram a aceitação do nosso produto.</p>
                            </div>
                        
                            <div class="col-2">
                                <img src="../imgs/tudo/graficos.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internas">
                <div class="row row-2">
                    <form class="pesq_text" action="./pesq_venda.php" name="form1" method="post">
                        <input type="number" name="id" class="id" placeholder="ID" autocomplete="off">
                        <input type="text" name="cliente" class="nome" placeholder="Cliente" autocomplete="off">
                        <input type="text" name="data" class="data" onKeyPress="MascaraData(form1.data);" maxlength="10" placeholder="Data de Nascimento" autocomplete="off">

                        <button type="submit" class="icon">
                            Filtrar
                        </button>

                    </form>
                </div>

                <div class="small-container">
                        <div class="tabela">
                            <div class="titulos">
                                <div class="produto">ID</div>
                                <div class="quant">Cliente</div>
                                <div class="quant">Data da compra</div>
                            </div>

                            <?php
                                $sql = "SELECT compra.id_compra, compra.data_compra, usuario.nome, usuario.sobrenome, usuario.id_user, compra.excluido 
                                FROM compra JOIN usuario ON compra.id_user=usuario.id_user
                                WHERE compra.excluido=false ORDER BY compra.id_compra";
                                
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);
                                
                                if($qtde > 0)
                                {

                                    for($cont=0; $cont < $qtde; $cont++)
                                    {
                                        $linha=pg_fetch_array($resultado);
                                        $data = date('d/m/Y',  strtotime($linha['data_compra']));

                                        echo "
                                        <a href='../front/mais_venda.php?id_compra=".$linha['id_compra']."'>
                                        <div class='produtos'>
                                            <div class='produto completa'>
                                                <div class='descricao'>
                                                    <br>
                                                    <p>".$linha['id_compra']."</p>
                                                </div>
                                            </div>

                                            <div class='quant'>
                                                <span>".$linha['nome']." ".$linha['sobrenome']."</span>
                                            </div>

                                            <div class='preco2'>
                                                <span>".$data."</span>
                                            </div>
                                        </div>
                                        </a>";
                                    }
                                }
                                else
                                {
                                    echo "<center><br><br><br><br><br><br><br><br><br><br><br><br><h1><div class='tabela'><b> Seu carrinho está vazio </b></div></h1> <br><br><br><br><br><br><br></center>";
                                }

                            ?>
                        </div> 
                    
                </div>

                <h3>Gráficos e estatísticas</h3>
                
                <div id="piechart" style="width: 900px; height: 500px;"></div>
            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                    <div class="footer">
                        <div class="navbar">
                            <section>
                                <ul id="MenuItems">
                                    <li><a href=""><span>Vendas</span></a></li>
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
                            <a href="graficos.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>

        <script type="text/javascript" src="../back/login_e_cadastro.js"></script>
    </body>
</html>