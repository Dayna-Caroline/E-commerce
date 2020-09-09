<?php
    $email = $_POST['email'];
    $nome = 'jorge';
    $titulo = 'aaa';
    $mensagem = 'oi';
    $destino = 'jg221204@gmail.com';
    $teste = mail($destino,$nome,$nome,$nome,$nome);
    
    if($teste == TRUE)
    {
        echo '<script language="javascript">';
        echo "alert('Email enviado!')";
        echo '</script>';
    }
    else
    {
        echo '<script language="javascript">';
        echo "alert('Email não encontrado! Tente novamente...')";
        echo '</script>';
    }

    header("Location: ../front/login_e_cadastro.php");
?>