
<!--João Gabriel Noce Laureano
    Criação: 24/08
    Última alteração: 31/08
 -->
 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empresa</title>
    
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
<?php
    include "conexao.php"; 
    $nome=$_POST['nome'];
    $sobrenome=$_POST['sobrenome'];
    $sexo=$_POST['sexo'];
    $data_nascimento=$_POST['data_nascimento'];
    $cpf=$_POST['cpf'];
    $telefone=$_POST['telefone'];
    $cep=$_POST['cep'];
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    $confirma_senha=$_POST['confirma-senha'];
    
    if($senha == $confirma_senha)
    {
        $sql="INSERT INTO \"user\" VALUES(DEFAULT, '$nome', '$sobrenome', '$sexo', '$data_nascimento', '$cpf', '$email', '$senha', '$telefone', '$cep', false, null, true);";
    
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);

        if ($linhas > 0)
        {
            echo "<br><br><br><br><br><br>Usuário registrado com sucesso!!!<br><br>";
            ?><a href="..\index.php">Retornar ao menu</a><br><br><?php
        }
        else	
        {
            echo "<br><br><br><br><br><br>Erro: Usuário não pode ser registrado";   
        }
    }
    else
    {
        echo "<br><br><br><br><br><br>Erro: Senhas diferentes";
    }
?>
</body>
</html>
