<!DOCTYPE html>
<?php
    include "conexao.php";
    
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data'];
    $cpf = $_POST['cpf'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $se = $_POST['senhaForca'];
    $confirma_senha = $_POST['confirma_senha'];
    $adm = $_POST['adm'];
    if($se != $confirma_senha)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: senhas diferentes!')";
        echo '</script>';
    }
    else if(strlen($data_nascimento) != 10)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: data de nascimento incorreta!(dd/mm/aaaa)')";
        echo '</script>';
    }
    else
    {
        $senha = base64_encode($se);
        if($adm == '1')
        {
            $sql = "INSERT INTO usuario VALUES(DEFAULT, '$nome', '$sobrenome', '$sexo', '$data_nascimento', '$cpf', '$email', '$senha', '$telefone', '$cep', FALSE, NULL, TRUE)";
        }
        else
        {
            $sql = "INSERT INTO usuario VALUES(DEFAULT, '$nome', '$sobrenome', '$sexo', '$data_nascimento', '$cpf', '$email', '$senha', '$telefone', '$cep', FALSE, NULL, FALSE)";
        }
        
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);
        if($linhas > 0)
        {
            header("Location: ../front/users_admin.php");
        }
        else	
        {
            echo '<script language="javascript">';
            echo "alert('Erro: Usuário não pôde ser cadastrado)')";
            echo '</script>';
        }
        
    }
?>  