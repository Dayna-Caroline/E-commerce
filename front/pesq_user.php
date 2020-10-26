<!DOCTYPE html>

<?php
    include "../back/conexao.php";

    $logado = null;
    $pesq = $_POST['pesq'];

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
                                    <li><a href="../front/graficos.php">Gráficos</a></li>
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
            <div class="row row-2">
                <form class="pesq_text" action="../front/pesq_user.php" method="post">
                    <input type="text" name="pesq" class="text" placeholder="Pesquisa">
                    <button type="submit" class="icon">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <div class="select">
                    <a href="insere_user.php"><button>Adicionar usuários</button></a>
                </div>
            </div>

            <div class="small-container">
                <div class="tabela">
                    <div class="titulos">
                        <div class="produto">Usuário</div>
                        <div class="quant">Administrador</div>
                        <div class="preco">Configurações</div>
                    </div>

                    <?php
                        if($pesq != '') //PESQUISA NÃO É EM BRANCO
                        {
                            $sql="SELECT * FROM usuario WHERE nome LIKE '%$pesq%' AND excluido=false ORDER BY id_user;"; //SELECIONA OS ATIVOS
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                            
                            if($qtde > 0)
                            {
                                $soma_total=0;

                                for($cont=0; $cont < $qtde; $cont++)
                                {
                                    $linha=pg_fetch_array($resultado);

                                    $ad=$linha['adm'];
                                    $sexo=$linha['sexo'];
                                    $id_user_select=$linha['id_user'];

                                    if($ad == 't'){
                                        $admin = 'Sim';
                                    }
                                    else{
                                        $admin = 'Não';
                                    }

                                    if($sexo == 'F'){
                                        $icon="<div class='feminino'><i class='fas fa-female'></i></div>";
                                    }
                                    else{
                                        $icon="<i class='fas fa-male'></i>";
                                    }

                                    echo "
                                    <div class='produtos'>
                                        <div class='produto completa'>
                                            <div class='img'>".$icon."</div>
                                            <div class='descricao'>
                                                <br>
                                                <p>".$linha['nome']." ".$linha['sobrenome']."</p>
                                                <p>".$linha['email']."</p>
                                                <a href='./detalhes_user.php?id_usuario=".$id_user_select."'>Mais detalhes</a>
                                            </div>
                                        </div>

                                        <div class='quant'>";

                                            echo "<p>".$admin."</p>

                                        </div>

                                        <div class='preco1'>
                                            <a href='./alterar_user_admin.php?id_usuario=".$id_user_select."'><i class='fas fa-user-edit'></i></a>
                                            <a href='./confirma_exclusao.php?id_usuario=".$id_user_select."'><i class='fas fa-trash-alt'></i></a>
                                        </div>
                                    </div>";
                                }
                            }
                            else
                            {
                                echo "<center><br><h1><div class='tabela'><b> Nenhum usuário ativo encontrado </b></div></h1><br></center>";
                            }
                                
                            echo "</div></div>";
            
                            $sql="SELECT *FROM usuario WHERE nome LIKE '%$pesq%' AND excluido=true ORDER BY id_user;"; //SELECIONA OS INATIVOS           
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        
                            if($qtde > 0)
                            {
                                echo "<div class='small-container'>
                                        <h2>Usuários Inativos</h2>
                                        <div class='tabela'>
                                            <div class='titulos'>
                                                <div class='produto'>Usuário</div>
                                                <div class='quant'>Administrador</div>
                                                <div class='preco'>Configurações</div>
                                            </div>";

                                for($cont=0; $cont < $qtde; $cont++)
                                {
                                    $linha=pg_fetch_array($resultado);

                                    $ad=$linha['adm'];
                                    $sexo=$linha['sexo'];
                                    $id_user_select=$linha['id_user'];

                                    if($ad == 't'){
                                        $admin = 'Sim';
                                    }
                                    else{
                                        $admin = 'Não';
                                    }

                                    if($sexo == 'F'){
                                        $icon="<div class='feminino'><i class='fas fa-female'></i></div>";
                                    }
                                    else{
                                        $icon="<i class='fas fa-male'></i>";
                                    }

                                    echo "
                                    <div class='produtos'>
                                        <div class='produto completa'>
                                            <div class='img'>".$icon."</div>
                                            <div class='descricao'>
                                                <br>
                                                <p>".$linha['nome']." ".$linha['sobrenome']."</p>
                                                <p>".$linha['email']."</p>
                                                <a href='./detalhes_user.php?id_usuario=".$id_user_select."'>Mais detalhes</a>
                                            </div>
                                        </div>

                                        <div class='quant'>";

                                            echo "<p>".$admin."</p>

                                        </div>

                                        <div class='preco2'>
                                            <a href=''>Reativar</a>
                                        </div>
                                    </div>";
                                }
                            }
                            else
                            {
                                //echo "<center><br><br><br><br><br><br><h1><div class='tabela'><b>Nenhum usuário inativo encontrado</b></div></h1> <br><br><br><br><br><br></center>";
                            }
                        }
                        else
                        {
                            $sql="SELECT *FROM usuario WHERE excluido='false' ORDER BY id_user;";
                                
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                            
                            if($qtde > 0)
                            {

                                for($cont=0; $cont < $qtde; $cont++)
                                {
                                    $linha=pg_fetch_array($resultado);

                                    $ad=$linha['adm'];
                                    $sexo=$linha['sexo'];
                                    $id_user_select=$linha['id_user'];

                                    if($ad == 't'){
                                        $admin = 'Sim';
                                    }
                                    else{
                                        $admin = 'Não';
                                    }

                                    if($sexo == 'F'){
                                        $icon="<div class='feminino'><i class='fas fa-female'></i></div>";
                                    }
                                    else{
                                        $icon="<i class='fas fa-male'></i>";
                                    }

                                    echo "
                                    <div class='produtos'>
                                        <div class='produto completa'>
                                            <div class='img'>".$icon."</div>
                                            <div class='descricao'>
                                                <br>
                                                <p>".$linha['nome']." ".$linha['sobrenome']."</p>
                                                <p>".$linha['email']."</p>
                                                <a href='./detalhes_user.php?id_usuario=".$id_user_select."'>Mais detalhes</a>
                                            </div>
                                        </div>

                                        <div class='quant'>";

                                            echo "<p>".$admin."</p>

                                        </div>

                                        <div class='preco1'>
                                            <a href='./alterar_user_admin.php?id_usuario=".$id_user_select."'><i class='fas fa-user-edit'></i></a>
                                            <a href='./confirma_exclusao.php?id_usuario=".$id_user_select."'><i class='fas fa-trash-alt'></i></a>
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

                            <?php
                            $sql="SELECT *FROM usuario WHERE excluido='true' ORDER BY id_user;";           
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                            
                            if($qtde > 0)
                            {
                                echo "<div class='small-container'>
                                        <h2>Usuários Inativos</h2>
                                        <div class='tabela'>
                                            <div class='titulos'>
                                                <div class='produto'>Usuário</div>
                                                <div class='quant'>Administrador</div>
                                                <div class='preco'>Configurações</div>
                                            </div>";

                                for($cont=0; $cont < $qtde; $cont++)
                                {
                                    $linha=pg_fetch_array($resultado);

                                    $ad=$linha['adm'];
                                    $sexo=$linha['sexo'];
                                    $id_user_select=$linha['id_user'];

                                    if($ad == 't'){
                                        $admin = 'Sim';
                                    }
                                    else{
                                        $admin = 'Não';
                                    }

                                    if($sexo == 'F'){
                                        $icon="<div class='feminino'><i class='fas fa-female'></i></div>";
                                    }
                                    else{
                                        $icon="<i class='fas fa-male'></i>";
                                    }

                                    echo "
                                    <div class='produtos'>
                                        <div class='produto completa'>
                                            <div class='img'>".$icon."</div>
                                            <div class='descricao'>
                                                <br>
                                                <p>".$linha['nome']." ".$linha['sobrenome']."</p>
                                                <p>".$linha['email']."</p>
                                                <a href='./detalhes_user.php?id_usuario=".$id_user_select."'>Mais detalhes</a>
                                            </div>
                                        </div>

                                        <div class='quant'>";
                                            echo "<p>".$admin."</p>
                                        </div>

                                        <div class='preco2'>
                                            <a href='../back/reativar_user.php?id_usuario=".$linha['id_user']."'>Reativar</a>
                                        </div>
                                    </div>";
                                }
                            }
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
                                    <li><a href="">Gráficos</a></li>
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