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

    $sql = "SELECT * FROM carrinho WHERE id_user = '$id_user' AND id_produto = '$id_prod'";
    $resultado = pg_query($conecta, $sql);
    $linhas = pg_affected_rows($resultado);

    if($linhas > 0)
    {
            $sql = "UPDATE carrinho SET quantidade='".($linha['quantidade']++)."' WHERE id_user='$id_user' AND id_produto='$id_prod';";
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
            }
    }
    else	
    {
        $sql = "INSERT INTO carrinho VALUES('$id_user', '$id_prod', '$add_um');";
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
        }
    }









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
    }
?>