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
        <link rel="stylesheet" href="../styles/conta.css">
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
                <!--Conta - Informações-------------------------------------------------------------------------------------------------------->
                <div class="small-container">
                    <h2>Informações da conta</h2>
                            <?php
                                $sql="SELECT * FROM usuario WHERE email = '$logado' AND excluido = FALSE";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);

                                if($qtde > 0){
                                        for($cont=0; $cont < $qtde; $cont++){
                                            $linha=pg_fetch_array($resultado);
                                            $sexo = 'F';
                                            if($linha['sexo'] == $sexo){
                                                $sexo = 'Feminino';
                                            }
                                            else{
                                                $sexo = 'Masculino';
                                            }

                                            $data = date('d/m/Y',  strtotime($linha['data_nascimento']));

                                            echo "<label>
                                            <div class='icon'><i class='fas fa-user'></i></div>
                                            <p>$linha[nome]</p>
                                        </label>
                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-user'></i></div>
                                            <p>$linha[sobrenome]</p>
                                        </label>
                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-venus-mars'></i></div>
                                            <p>$sexo</p>
                                        </label>
                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-calendar-alt'></i></div>
                                            <p>$data</p>
                                        </label>
                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-address-card'></i></div>
                                            <p>$linha[cpf]</p>
                                        </label>
                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-map-marked-alt'></i></div>
                                            <p>$linha[cep]</p>
                                        </label>
                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-mobile'></i></div>
                                            <p>$linha[telefone]</p>
                                        </label>
                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-envelope-open-text'></i></div>
                                            <p>$linha[email]</p> 
                                        </label>
                                        
                                        <label>
                                            <div class='icon'><i class='fas fa-lock'></i></div>   
                                            <p>$linha[senha]</p>
                                        </label>";
                                        }
                                }

                            ?>
                    <div class="botoes">
                        <button><a href="../front/altera_user.php">Alterar informação</a></button>
                        <button><a href="">Ver histórico</a></button>
                        <button><a href="../back/logout.php">Sair</a></button>
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
                            <a href="carrinho.php">Voltar ao inicio</a>
                        </div>
                    </div>
            </div>                  
        </div>
    </body>
</html>