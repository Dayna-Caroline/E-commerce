<?php
    include "conexao.php";

    $id_usuario = $_GET['id_usuario'];

    $logado = null;

    session_start();
    
    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $id_user = $_SESSION['id_user'];
    }

    $sql = "UPDATE usuario SET excluido = FALSE WHERE id_user = '$id_usuario'";
    
    $resultado = pg_query($conecta, $sql);
    $linhas = pg_affected_rows($resultado);

    if($linhas > 0)
    {
        header("Location: ../front/users_admin.php");
    }
    else	
    {
        echo '<script language="javascript">';
        echo "alert('Não foi possível reativar o usuário.')";
        echo '</script>';
    }

?>