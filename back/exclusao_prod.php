<?php
    include "conexao.php";

    $id = $_GET['id'];

    $logado = null;

    session_start();
    
    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $id_user = $_SESSION['id_user'];
    }

        $sql = "UPDATE produto SET excluido=TRUE WHERE id_produto=$id";
    
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);

        if($linhas > 0)
        {
            header("Location: ../front/prod_admin.php");
        }
        else	
        {
            echo '<script language="javascript">';
            echo "alert('Não foi possível excluir o produto.')";
            echo '</script>';
        }
?>