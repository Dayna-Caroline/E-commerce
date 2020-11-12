<?php
    include "../back/conexao.php";

    $id = $_GET['id'];
    $produto = $_POST['produto'];
    $cupormug = $_POST["cupormug"];
    $descricao = $_POST['descricao'];
    $qtdd = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $material = $_POST['material'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];

        $se = base64_encode($senha);
        
        $sql = "UPDATE produto SET produto='$produto', cupormug='$cupormug', descricao='$descricao', quantidade='$qtdd', preco='$preco', imagem='$imagem', material='$material', cor='$cor', tamanho='$tamanho' WHERE id_produto='$id';";
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);

        if($linhas > 0)
        {
            header("Location: ../front/prod_admin.php");
        }
        else	
        {
            echo '<script language="javascript">';
            echo "alert('Não foi possível alterar as informações!')";
            echo '</script>';
        }

?>