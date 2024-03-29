<!--Dayna Caroline - N°11 - Criação: 02/09-->
<!--Augusto Creppe - N°06 e Dayna Caroline - N°11 - Atualização: 09/09-->

<!DOCTYPE html>

<?php
    include "../back/conexao.php";

    $id_usuario = $_GET['id_usuario'];

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
                <!--Conta - Informações-------------------------------------------------------------------------------------------------------->
                <form action="../back/altera_user_admin.php" method="post" class="small-container" name="form1">
                    <h2>Informações da conta</h2>

                            <?php
                                $sql="SELECT * FROM usuario WHERE id_user = '$id_usuario' AND excluido = FALSE";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);

                                if($qtde > 0)
                                {
                                    for($cont=0; $cont < $qtde; $cont++)
                                    {
                                        $linha=pg_fetch_array($resultado);
                                        $sexo = 'F';
                                        if($linha['sexo'] == $sexo)
                                        {
                                            $sexo = 'Feminino';
                                        }
                                        else
                                        {
                                            $sexo = 'Masculino';
                                        }

                                        $usuario = 't';
                                        if($linha['adm'] == $usuario)
                                        {
                                            $usuario = 'Administrador';
                                        }
                                        else
                                        {
                                            $usuario = 'Cliente';
                                        }

                                        $data = date('d/m/Y',  strtotime($linha['data_nascimento']));

                                        $se = $linha['senha'];
                                        $senha = base64_decode($se);

                                        echo "
                                    <input type='hidden' id='id_usuario' name='id_usuario' value='".$id_usuario."'>

                                    <label>
                                        <div class='icon'><i class='fas fa-user'></i></div>
                                        <input type='text' name='nome' value='".$linha['nome']."' autocomplete='off'>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-user'></i></div>
                                        <input type='text' name='sobrenome' value='".$linha['sobrenome']."' autocomplete='off'>
                                    </label>

                                    <label>
                                        <div class='icon'><i class='fas fa-venus-mars'></i></div>
                                        <div class='col-radio'>
                                                <input type='radio' name='sexo' value='F' class='radio' "; if($sexo=='Feminino'){echo"checked";} echo " autocomplete='off'><p>Feminino</p> &#160;&#160;&#160;&#160;&#160;
                                                <input type='radio' name='sexo' value='M' class='radio' "; if($sexo=='Masculino'){echo"checked";} echo " autocomplete='off'><p>Masculino</p>
                                        </div>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-calendar-alt'></i></div>
                                        <input type='text' name='data' onKeyPress='MascaraData(form1.data);' maxlength='10' value='".$data."' autocomplete='off'>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-address-card'></i></div>
                                        <input type='text' name='cpf' onKeyPress='MascaraCPF(form1.cpf);' maxlength='14' value='".$linha['cpf']."' autocomplete='off'>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-map-marked-alt'></i></div>
                                        <input type='text' name='cep' onKeyPress='MascaraCep(form1.cep);' maxlength='10' value='".$linha['cep']."' autocomplete='off'>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-mobile'></i></div>
                                        <input type='text' name='telefone' onKeyPress='MascaraTelefone(form1.telefone);' maxlength='15' value='".$linha['telefone']."' autocomplete='off'>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-envelope-open-text'></i></div>
                                        <input type='email' name='email' value='".$linha['email']."' autocomplete='off'> 
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-lock'></i></div>   
                                        <input type='password' name='senhaForca' id='senhaForca' value='".$senha."' onkeyup='validarSenhaForca()'>
                                        <div id='erroSenhaForca' class='forca'></div>
                                    </label>
                                    
                                    <label>
                                        <div class='icon'><i class='fas fa-lock'></i></div>
                                        <input type='password' name='confirma_senha' value='".$senha."' autocomplete='off'>
                                    </label>

                                    <label>
                                        <div class='icon'><i class='fas fa-id-badge'></i></div>
                                        <div class='col-radio'>
                                            <input type='radio' name='usuario' value='Administrador' class='radio' "; if($usuario=='Administrador'){echo"checked";} echo " autocomplete='off'><p>Administrador</p>
                                            <input type='radio' name='usuario' value='Cliente' class='radio' "; if($usuario=='Cliente'){echo"checked";} echo " autocomplete='off'><p>Cliente</p>
                                        </div>
                                    </label>";
                                    }
                                }
                            ?>

                    <div class="botoes">
                        <button type="submit">Salvar Alterações</button>
                        <button><a href="../front/users_admin.php">Voltar</a></button>
                    </div>  
                </form>   
            </div> <!--Internas-->

            <div class="rodape">
                
                <!--Footer-------------------------------------------------------------------------------------------------------------------->
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
                        <a href="alterar_user_admin.php">Voltar ao inicio</a>
                    </div>
                </div>
            </div>                  
        </div>

        <script type="text/javascript" src="../back/login_e_cadastro.js"></script>
    </body>
</html>