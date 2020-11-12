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
        <link rel="stylesheet" href="../styles/insere_user.css">
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
                                        <li><a href="../front/graficos.php">Gráficos</a></li>
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
                <!--Conta - Informações-------------------------------------------------------------------------------------------------------->
                <form action="../back/cad_produto.php" method="post" class="small-container">
                    <h2>Cadastrar produto</h2>
                    
                    <label>
                        <div class='icon'><i class="fas fa-pencil-alt"></i></div>
                        <input type='text' name='produto' placeholder='Produto' class="texto" required>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class="fas fa-align-justify"></i></div>
                        <input type='text' name='descricao' placeholder='Descrição' class="texto" required>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class="fas fa-beer"></i></div>
                        <div class="col-radio">
                                <input type="radio" name="cupormug" value="1" class="radio"><p>Copo</p required> &#160;&#160;&#160;&#160;&#160;
                                <input type="radio" name="cupormug" value="2" class="radio"><p>Caneca</p required>
                        </div>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class="fas fa-pen-fancy"></i></div>
                        <input type='text' class="texto" name='material' placeholder='Material' required>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class="fas fa-palette"></i></div>
                        <input type='text' class="texto" name='cor' placeholder='Cor' required>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class="fas fa-ruler"></i></div>
                        <input type='number' class="texto" name='tamanho' placeholder='Tamanho' required>
                    </label>
                                    
                    <label>
                        <div class='icon'><i class="fas fa-images"></i></div>
                        <input type='text' class="texto" name='imagem' placeholder='Imagem'> 
                    </label>
                                    
                    <label>
                        <div class='icon'><i class="fas fa-clipboard-list"></i></div>
                        <input type='number' class="texto" name='quantidade' placeholder='Estoque' required> 
                    </label>
                                    
                    <label>
                        <div class='icon'><i class="fas fa-dollar-sign"></i></div>
                        <input type='number' class="texto" name='preco' placeholder='Preço' required>
                    </label>


                    <div class="botoes">
                        <button type="submit">Criar produto</button>
                        <button><a href="../front/prod_admin.php">Voltar</a></button>
                    </div>  
                </form>   
            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
                <div class="footer">
                    <div class="navbar">
                        <section>
                        <ul id="MenuItems">
                                    <li><a href="graficos.php">Gráficos</a></li>
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
                        <a href="add_prod.php">Voltar ao inicio</a>
                    </div>
                </div>
            </div>                  
        </div>

    </body>
</html>