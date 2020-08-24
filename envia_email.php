<!--João Gabriel Noce Laureano
    Criação: 24/08
    Última alteração: 24/08
 -->
 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empresa</title>
    
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <?php
    $email = $_POST['email'];
    $nome = 'jorge';
    $titulo = 'aaa';
    $mensagem = 'oi';
    $destino = 'jg221204@gmail.com';
    $teste = mail($destino,$nome,$nome,$nome,$nome);
    if($teste == TRUE)
    echo"Email enviado";
    else
    echo"Email não encontrado";?> 
</body>
</html>