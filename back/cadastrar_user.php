<?php
    include "conexao.php";
    
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];
    
    if($senha == $confirma_senha)
    {
        $sql = "INSERT INTO public.user VALUES(DEFAULT, '$nome', '$sobrenome', '$sexo', '$data_nascimento', '$cpf', '$email', '$senha', '$telefone', '$cep', false, null, false);";
    
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);

        if($linhas > 0)
        {
            echo '<script language="javascript">';
            echo "alert('Cadastro realizado com sucesso!')";
            echo '</script>';
            
            header("Location: ../index.php");
        }
        else	
        {
            echo '<script language="javascript">';
            echo "alert('Usuário não pode ser registrado!')";
            echo '</script>';
        }
    }
    else
    {
        echo '<script language="javascript">';
        echo "alert('Erro: senhas diferentes!')";
        echo '</script>';
    }
?>