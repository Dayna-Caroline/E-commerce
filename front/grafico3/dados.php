<?php
    include "../../back/conexao.php";

    $sql9 = "SELECT usuario.data_nascimento, itens.quantidade, produto.id_produto
    FROM compra JOIN itens ON itens.id_compra=compra.id_compra
    INNER JOIN produto ON itens.id_produto=produto.id_produto
    INNER JOIN usuario ON compra.id_user=usuario.id_user
    ORDER BY usuario.data_nascimento";

    $resultado9 = pg_query($conecta, $sql9);
    $qtde9 = pg_num_rows($resultado9);
    $sfaixas = array('Abaixo de 16', '16 a 20', '20 a 40', 'Acima de 40 anos');
    $faixas = array();
    $quantidade = array();
    $i = 0;
    $data = array();

    if($qtde9 > 0)
    {
        for($cont9=0; $cont9 < $qtde9; $cont9++)
        {
            $linha9=pg_fetch_array($resultado9);
            $quanti = $linha9['quantidade'];
            $id = $linha9['id_produto'];
            list($ano, $mes, $dia) = explode('-', $linha9['data_nascimento']);

            if(empty($data[$id])){
                $data[$id] = $ano;
                $quantidade[$id] = $quanti;
            }
            else{
                if($data[$id] == $ano){
                    $quantidade[$id] += $quanti;
                }
                else{
                    if($quantidade[$id] < $quanti){
                        $quantidade[$id] = $quanti;
                        $data[$id] = $ano;
                    }
                }
            }
        }

        for($a = 0; $a < 12; $a++){
            if(empty($data[$a])){
                $faixas[$i] = '-';
                $quantidade[$i] = 0;
                $data[$a] = 0;
            }

            if($data[$a])
        }
    }
?>