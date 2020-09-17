<?php
    include "conexao.php";
    $id_prod = $_GET["id_prod"];

    $logado = null;

    session_start();
    
    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $id_user = $_SESSION['id_user'];
    }

    $qtde = '1';

    $sql = "SELECT * FROM carrinho WHERE id_produto = '$id_prod'";
    
    $resultado = pg_query($conecta, $sql);
    $linhas = pg_affected_rows($resultado);

    if($linhas > 0){
        header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
        exit;
    }
    
    else{
        $sql = "INSERT INTO carrinho VALUES('$id_user', '$id_prod', '$qtde');";
    
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);

        if($linhas > 0)
        {
            header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
            exit;
        }
        else	
        {
            echo '<script language="javascript">';
            echo "alert('Erro ao adicionar no carrinho!')";
            echo '</script>';
            header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
            exit;
        }
    }
?>