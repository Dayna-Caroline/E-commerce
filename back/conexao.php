<?php

    $stringdeconexao = "host=localhost port=5432 dbname=a11daynaprado user=a11daynaprado password=cti";
    
    $conecta = pg_connect($stringdeconexao);
    
    if (!$conecta) {
        
        echo "Não foi possível estabelecer conexão com o banco de dados!";
        
        exit;
    }
?>