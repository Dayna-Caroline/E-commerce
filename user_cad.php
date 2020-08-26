
<!--João Gabriel Noce Laureano
    Criação: 24/08
    Última alteração: 24/08
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
    include "back/conexao.php"; 
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
    if($sexo!='M'&&$sexo!='m'&&$sexo!='F'&&$sexo!='f')
    {
        echo"Sexo deve ser M ou F!";
    }
    else{
        if($confirma_senha == $senha)
        {
            $sql="INSERT INTO user VALUES(3, '$nome', '$sobrenome', '$sexo', '$data_nascimento', '$cpf', '$email', '$senha', '$telefone', '$cep', false, null, true);";
            $resultado = pg_query($conecta, $sql);
            $linhas=pg_affected_rows($resultado);
            echo $sql."a".$resultado."a". $linhas;
            if ($linhas > 0)
                echo "Usuário registrado com sucesso!!!";
            else	
                echo "Erro: usário não pode ser registrado";
        }
        else
        {
            echo"Senhas não coincidem!";
        }
    }
    
?>
</body>
</html>
