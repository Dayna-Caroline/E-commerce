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
    $senha = $_POST['senhaForca'];
    $confirma_senha = $_POST['confirma_senha'];
    
    if($senha != $confirma_senha)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: senhas diferentes!')";
        echo '</script>';
    }
    else if(strlen($senha) < 4)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: senha muito curta')";
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
        
        $sql = "INSERT INTO usuario VALUES(DEFAULT, '$nome', '$sobrenome', '$sexo', '$data_nascimento', '$cpf', '$email', '$senha', '$telefone', '$cep', false, null, false);";
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);
        if($linhas > 0)
        {
            session_start();

            $_SESSION['email'] = $email;
            $_SESSION['adm'] = false;
            $_SESSION['nome'] = $nome;
            $_SESSION['sexo'] = $sexo;

            $sql2 = "SELECT * FROM usuario WHERE email='$email';";
            $resultado2 = pg_query($conecta, $sql2);
            $linhas2 = pg_affected_rows($resultado2);
            if($linhas > 0)
            {
                $linhas3 = pg_fetch_array($resultado2);
                $id_bckp = $linhas3['id_user'];
                $_SESSION['id_user'] = $id_bckp;
            }

            header("Location: ../index.php");
        }
        else	
        {
            echo '<script language="javascript">';
            echo "alert('Usuário não pode ser registrado!')";
            echo '</script>';
        }
        
    }
?>