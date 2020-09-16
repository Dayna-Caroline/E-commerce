<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form action="../back/cad_produto.php" method="post" enctype="multipart/form-data">
        Produto<input type="text" name="produto"> <br>
        1 - Copo, 2 - Caneca <input type="number" name="cupormug" id=""> <br>
        Descrição <input type="text" name="descricao" id=""> <br>
        Quantidade <input type="text" name="qtdd" id=""> <br>
        Preço <input type="text" name="preco" id=""> <br>
        Imagem <input type="text" name="imagem" id=""> <br>
        Material <input type="text" name="material" id=""> <br>
        Cor <input type="text" name="cor" id=""> <br>
        Tamanho <input type="text" name="tamanho" id=""> <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>