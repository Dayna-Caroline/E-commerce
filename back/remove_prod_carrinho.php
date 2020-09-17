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

    $sql = "DELETE FROM carrinho WHERE id_produto = '$id_prod'";
    
    $resultado = pg_query($conecta, $sql);
    $linhas = pg_affected_rows($resultado);

    header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
    exit;

?>