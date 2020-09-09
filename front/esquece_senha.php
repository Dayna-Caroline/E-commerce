<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empresa</title>
    
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <h2 class="titulo titulo-segundo">Digite o email</h2>
    <form action="../back/envia_email.php" method="post" class="form">
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" class="btn btn-segundo">Enviar</button>  
    </form>   
</body>
</html>