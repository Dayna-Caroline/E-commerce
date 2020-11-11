<?php
    include "../../back/conexao.php";

    //Gráfico 3-------------------------------------------------------------------------------------
        $sql9 = "SELECT usuario.data_nascimento, itens.quantidade, produto.id_produto
        FROM compra JOIN itens ON itens.id_compra=compra.id_compra
        INNER JOIN produto ON itens.id_produto=produto.id_produto
        INNER JOIN usuario ON compra.id_user=usuario.id_user
        ORDER BY usuario.data_nascimento";

        $resultado9 = pg_query($conecta, $sql9);
        $qtde9 = pg_num_rows($resultado9);
        $sfaixas = array('Abaixo de 16', '17 a 20', '21 a 40', 'Acima de 41 anos', '-', '+ de uma faixa');
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

                if(empty($data[$id-1])){
                    $data[$id-1] = $ano;
                    $quantidade[$id-1] = $quanti;
                }
                else{
                    if($data[$id-1] == $ano){
                        $quantidade[$id-1] += $quanti;
                    }
                    else{
                        if($quantidade[$id-1] < $quanti){
                            $quantidade[$id-1] = $quanti;
                            $data[$id-1] = $ano;
                        }
                        else if($quantidade[$id-1] == $quanti){
                            $faixas[$id-1] = $sfaixas[6];
                        }
                    }
                }
            }

            for($a = 0; $a < 12; $a++){
                if(empty($faixas[$a])){
                    if(empty($data[$a])){
                        $faixas[$a] =  $sfaixas[5];
                        $quantidade[$a] = 0;
                        $data[$a] = 0;
                    }
                    else{
                        if((2020 - $data[$a]) < 17){
                            $faixas[$a] = $sfaixas[1];
                        }
                        else if((2020 - $data[$a]) < 21){
                            $faixas[$a] = $sfaixas[2];
                        }
                        else if((2020 - $data[$a]) < 41){
                            $faixas[$a] = $sfaixas[3];
                        }
                        else if((2020 - $data[$a]) > 40){
                            $faixas[$a] = $sfaixas[3];
                        }
                    }
                }
            }
            ksort($quantidade);
            ksort($faixas);
        }
    //----------------------------------------------------------------------------------------------
?>