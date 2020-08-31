<!--João Gabriel Noce Laureano
    Criação: 24/08
    Última alteração: 31/08
 -->
<?php

    $conecta = pg_connect("host=localhost port=5432 dbname=a11daynaprado user=a11daynaprado password=cti");
    if (!$conecta) {
        
        echo "Não foi possível estabelecer conexão com o banco de dados!";
        
        exit;
    }
?>