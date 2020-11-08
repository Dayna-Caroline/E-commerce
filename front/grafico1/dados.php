<?php
    include "../../back/conexao.php";

    //Padrão String Produtos--------------------------------------------------------------------------------
    $sql = "SELECT produto FROM produto ORDER BY id_produto";
    $resultado = pg_query($conecta, $sql);
    $qtde = pg_num_rows($resultado);
    $sprod=array();
    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=pg_fetch_array($resultado);
            $produto = $linha['produto'];
            $sprod[$cont] = $produto;
        }
    }

    $ind_prod = count($sprod); 

    //Dados gráfico 1----------------------------------------------------------------------------------------------
    $sql3 = "SELECT itens.id_produto, itens.quantidade
    FROM itens JOIN produto ON itens.id_produto=produto.id_produto
    ORDER BY itens.id_produto";
    $resultado3 = pg_query($conecta, $sql3);
    $qtde3 = pg_num_rows($resultado3);
    $squant3=array();
    $sporcentagem3=array();
    $qtotal3=0;

    if($qtde3 > 0)
    {
        for($cont3=0; $cont3 < $qtde3; $cont3++)
        {
            $linha3=pg_fetch_array($resultado3);
            $id_produto3 = $linha3['id_produto'];
            $quantidade3 = $linha3['quantidade'];
            $squant3[$id_produto3-1] = $quantidade3;
            $qtotal3 += $quantidade3; 
        }
    }
    
    for($x3=0; $x3 < $ind_prod; $x3++){
        if(empty($squant3[$x3])){
            $squant3[$x3] = 0;
            $sporcentagem3[$x3] = '0%';
        }
        else{
            $por3 = ($squant3[$x3] * 100)/$qtotal3;
            $sporcentagem3[$x3] = round($por3) . '%';
        }
    }
    ksort($sprod);
    ksort($squant3); 
    //-------------------------------------------------------------------------------------------------------

?>

