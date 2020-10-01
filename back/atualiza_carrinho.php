<?php
    include "conexao.php";
    $id_prod = $_POST["id_prod"];
    $qtd_prod = $_POST["qtde"];

    $logado = null;

    session_start();
    
    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $id_user = $_SESSION['id_user'];
        echo "AQUI - ".$id_user;
    }

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
?>