<?php
    include "conexao.php";
    $id_prod = $_POST["id_prod"];
    $qtd_prod = $_POST["qtd_prod"];
    $estoque = $_POST["estoque"];
    $muda = $_POST["muda"];

    $logado = null;

    session_start();
    
    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $id_user = $_SESSION['id_user'];
    }

    if($muda == 1 && ($qtd_prod-1 > 0))
    {
        $qtd_prod-=1;

        $sql="UPDATE carrinho SET quantidade=$qtd_prod WHERE id_user=$id_user AND id_produto=$id_prod";
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
            echo "alert('Erro ao atualizar carrinho!')";
            echo '</script>';
        }
    }
    else if($muda == 2 && ($qtd_prod+1 <= $estoque))
    {
        $qtd_prod+=1;
        
        $sql="UPDATE carrinho SET quantidade=$qtd_prod WHERE id_user=$id_user AND id_produto=$id_prod";
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
            echo "alert('Erro ao atualizar carrinho!')";
            echo '</script>';
        }
    }
    else
    {
        header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
        exit;
    }
?>