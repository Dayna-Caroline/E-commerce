<?php
    include "conexao.php";
    
    $produto = $_POST['produto'];
    $cupormug = $_POST["cupormug"];
    $descricao = $_POST['descricao'];
    $qtdd = $_POST['qtdd'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $material = $_POST['material'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];

    $sql = "INSERT INTO produto VALUES(DEFAULT, '$produto', '$cupormug', '$descricao', '$qtdd', '$preco', '$imagem', '$material', '$cor', '$tamanho', false, null);";
    
    $resultado = pg_query($conecta, $sql);
    $linhas = pg_affected_rows($resultado);

    if($linhas > 0)
    {
        echo "Salvo com sucesso";
    }
    else	
    {
        echo '<script language="javascript">';
        echo "alert('Não pode ser registrado!')";
        echo '</script>';
    }
?>