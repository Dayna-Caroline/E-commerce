<?php
include "../../back/conexao.php";

//Gráfico 5-------------------------------------------------------------------------------------------------
    $sql5 = "SELECT compra.data_compra, produto.preco, itens.quantidade
    FROM compra JOIN itens ON itens.id_compra=compra.id_compra
    INNER JOIN produto ON itens.id_produto=produto.id_produto
    ORDER BY compra.data_compra";

    $resultado5 = pg_query($conecta, $sql5);
    $qtde5 = pg_num_rows($resultado5);
    $sdatas = array();
    $fvalores = array();
    $qtdd = array();
    $i = 0;

    if($qtde5 > 0)
    {
        for($cont5=0; $cont5 < $qtde5; $cont5++)
        {
            $linha5=pg_fetch_array($resultado5);
            $data = date('d/m/Y',  strtotime($linha5['data_compra']));
            $quant = $linha5['quantidade'];
            $preco = $linha5['preco'];

            if(empty($sdatas[0])){
                $sdatas[0] = $data;
                $dt_ant = $data;
                $fvalores[0] = ($quant * $preco);
                $qtdd[0] = $quant;
            }
            else{
                if(strtotime($dt_ant) == strtotime($data)){
                    $fvalores[$i] += ($quant * $preco);
                    $qtdd[$i] += $quant;
                }else{
                    array_push($sdatas, $data);
                    $dt_ant = $data;
                    array_push($fvalores, ($quant * $preco));
                    array_push($qtdd, $quant);
                    $i++;
                }
            }
        }
    }
?>