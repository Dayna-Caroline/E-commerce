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

    if($id_user != $id_usuario)
    {
        $sql = "UPDATE usuario SET excluido=TRUE WHERE id_user=$id_usuario";
    
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);

        if($linhas > 0)
        {
            header("Location: ../front/users_admin.php");
        }
        else	
        {
            echo '<script language="javascript">';
            echo "alert('Não foi possível excluir o usuário.')";
            echo '</script>';
        }
    }
    else	
    {
        echo '<script language="javascript">';
        echo "alert('Não é possível excluir um usuário logado!')";
        echo '</script>';
    }
?>