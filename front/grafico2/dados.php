<?php
include "../../back/conexao.php";

//Gráfico 5-------------------------------------------------------------------------------------------------
    $sql5 = "SELECT compra.data_compra, produto.preco, itens.quantidade
    FROM compra JOIN itens ON itens.id_compra=compra.id_compra
    INNER JOIN produto ON itens.id_produto=produto.id_produto
    ORDER BY compra.data_compra";

    $resultado5 = pg_query($conecta, $sql5);
    $qtde5 = pg_num_rows($resultado5);
    
    $fvalores5 = array();
    $sdatas = array('08/11/2020');
    
    $dt_ant5 = 0;
    $compra = array();
    $i = -1;

    if($qtde5 > 0)
    {
        for($cont5=0; $cont5 < $qtde5; $cont5++)
        {
            $linha5=pg_fetch_array($resultado5);
            $data = date('d/m/Y',  strtotime($linha5['data_compra']));
            $preco = ($linha5['preco']*$linha5['quantidade']);

            if(!strtotime($data) == strtotime($dt_ant5)){
                $i++;
                array_push($sdatas, $data);
                $fvalores5[$i+1] = $preco;
                $compra[$i+1] = 1;
                $dt_ant5 = $data;
            }else{
                $fvalores5[$i+1] += $preco;
                $compra[$i+1] ++;
            }
        }
    }
?>