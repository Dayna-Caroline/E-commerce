<?php
    require("./fpdf/fpdf.php");
    include "conexao.php";

    class PDF extends FPDF
    {
        function Header() {
            $this->Image('../imgs/tudo/melhor.jpg',30,25,50);
            $this->Ln(40);
        }

        function rodape() {
            $this->SetY(250);
            
            $this->Cell(68);
            $this->SetFont('Arial','b',13);
            date_default_timezone_set("America/Sao_Paulo");
            $this->Cell(52, 8, "Gerado eletrônicamente em ".date("d/m/y (G:i)"), 0, 0, 'C');
            
            $this->Ln(6);
            
            $this->SetFont('Arial','i',13);
            
            $this->Cell(0,10,'Cup&Mug@2020',0,0,'C');
        
            $this->Ln(6);
        
            $this->Cell(0,10,'A. Freitas, A. Creppe, D. Caroline, J. Laureano, J. Gutierrez, M. Agostini',0,0,'C');
        }

        function Title() {

            $this->SetFont('Arial','b',24);
            
            $this->Ln(-5);
            $this->Cell(20);
            $this->Cell(150,15,"Relatório de vendas",1,50,'C');
           
            $this->SetFont('Arial','b',20);
                
            $this->Ln(15);
        }
        
        function ReceiptHeader($header, $title) {
            $this->SetFont('Arial','b',16);

            $this->SetFillColor(255,255,255);
            $this->Cell(190, 15, $title, 0, 0, 'C', true);
            $this->Ln(17);

            // Header
            $this->Cell(20, 15, "", 0, 0, 'C', true);
            $this->SetFillColor(255,60,60);

            foreach($header as $column)
                $this->Cell(50, 8, $column, 1, 0, 'C', true);
            
            $this->Ln(8);
        }

        function ReceiptData($a, $b, $c) {
            $this->SetFont('Arial','',13);
            
            for($i=0; $i<count($a); $i++)
            {
                //Quebra pagina?
                if(($i%29) == 0 && $i != 0)
                {
                    $this->AddPage();
                    $this->Ln(26);
                }
                
                //Color
                if($i%2 == 1)
                {
                    $this->SetFillColor(255,255,255);
                    $this->Cell(20, 8, "", 0, 0, 'C', true);
                    $this->SetFillColor(220,220,220);
                }
                else
                {
                    $this->SetFillColor(255,255,255);
                    $this->Cell(20, 8, "", 0, 0, 'C', true);
                    $this->SetFillColor(255,255,255);
                }
                

                $this->SetFont('Arial','b',11);
                $this->Cell(50, 8, $a[$i], 1, 0, 'C', true);
                $this->Cell(50, 8, $b[$i], 1, 0, 'C', true);
                $this->Cell(50, 8, $c[$i], 1, 0, 'C', true);

                
                $this->Ln();
            }
        }
    }

    /*----------------------------------------------------------------------------*/

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

    //Gráfico 2-------------------------------------------------------------------------------------------------
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

    //----------------------------------------------------------------------------------------------

    //Gráfico 3-------------------------------------------------------------------------------------
        $sql9 = "SELECT usuario.data_nascimento, itens.quantidade, produto.id_produto
        FROM compra JOIN itens ON itens.id_compra=compra.id_compra
        INNER JOIN produto ON itens.id_produto=produto.id_produto
        INNER JOIN usuario ON compra.id_user=usuario.id_user
        ORDER BY usuario.data_nascimento";

        $resultado9 = pg_query($conecta, $sql9);
        $qtde9 = pg_num_rows($resultado9);
        $sfaixas = array('Abaixo de 16', '17 a 20', '21 a 40', 'Acima de 41 anos');
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
                    $faixas[$a] = '-';
                    $quantidade[$a] = 0;
                    $data[$a] = 0;
                }
                else{
                    if((2020 - $data[$a]) <= 16){
                        $faixas[$a] = $sfaixas[1];
                    }
                    else if((2020 - $data[$a]) > 17 && $data[$a] <= 20){
                        $faixas[$a] = $sfaixas[2];
                    }
                    else if((2020 - $data[$a]) > 21 && $data[$a] <= 40){
                        $faixas[$a] = $sfaixas[3];
                    }
                    else if((2020 - $data[$a]) >= 41){
                        $faixas[$a] = $sfaixas[4];
                    }
                }
            }
            ksort($quantidade);
            ksort($faixas);
        }
    //----------------------------------------------------------------------------------------------

    //Gráfico 4-------------------------------------------------------------------------------------
        $sql4 = "SELECT usuario.sexo, compra.id_compra
            FROM compra JOIN usuario ON compra.id_user=usuario.id_user";
        $resultado4 = pg_query($conecta, $sql4);
        $qtde4 = pg_num_rows($resultado4);
        $sf4 = 0;
        $sm4 = 0;
        $total = 0;

        if($qtde4 > 0)
        {
            for($cont4=0; $cont4 < $qtde4; $cont4++)
            {
                $linha4=pg_fetch_array($resultado4);
                $sexo4 = $linha4['sexo'];

                if($sexo4 == 'F'){
                    $sf4++;
                }else{
                    $sm4++;
                }

                $total ++;
            }
        }
        $genero = array('Feminino', 'masculino');
        $scompras = array($sf4, $sm4);
        $porc = array(round(($sf4*100)/$total), round(($sm4*100)/$total));

    //--------------------------------------------------------------------------------------------------------


    pg_close($conecta);

    /*--------------------------------------------------------------------------------------------*/

    $table1 = ['Nome do produto', 'Quantidade', '%'];
    $table2 = ['Data', 'Vendas(%)', 'Faturamento'];
    $table3 = ['Produto', 'Faixa etária', 'Compras'];
    $table4 = ['Gênero', 'Compras', '%'];

    //PDF Initialization
    $pdf = new PDF();
    $pdf->AliasNbPages();

    //Intro
    $pdf->AddPage();
        $pdf->Title();
        $pdf->ReceiptHeader($table1, 'Quantidade e porcentagem de vendas de todos os produtos.');
        $pdf->ReceiptData($sprod, $squant3, $sporcentagem3);
        $pdf->ReceiptHeader($table2, 'Porcentagem e faturamento de vendas por data.');
        $pdf->ReceiptData($sdatas, $qtdd, $fvalores);
        $pdf->ReceiptHeader($table3, 'Produtos mais vendidos por faixa etária.');
        $pdf->ReceiptData($sprod, $faixas, $quantidade);
        $pdf->ReceiptHeader($table4, 'Preferência de compra por gênero.');
        $pdf->ReceiptData($genero, $scompras, $porc);
        $pdf->rodape();
    //Show
    $pdf->Output('I', 'Relatorio_vendas.pdf');
?>