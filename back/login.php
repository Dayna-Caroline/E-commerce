<?php
    include "conexao.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $result = pg_query("SELECT * FROM usuario WHERE email ='$email' AND senha = '$senha'");
    
    $linha = pg_fetch_array($result);
    $adm = $linha['adm'];
    $nome = $linha['nome'];
    $sexo = $linha['sexo'];
    $id_user = $linha['id_user'];

    if(pg_num_rows($result) > 0)
    {
        session_start();

        $_SESSION['email'] = $email;
        $_SESSION['adm'] = $adm;
        $_SESSION['nome'] = $nome;
        $_SESSION['sexo'] = $sexo;
        $_SESSION['id_user'] = $id_user;

        header("Location: ../index.php");
    }
    else
    {
        header("Location: ../front/login_e_cadastro.php?success=false");
    }
?>