<?php
    require("./fpdf/fpdf.php");

    class PDF extends FPDF
    {
        function Header() {
            $this->Image('../imgs/tudo/melhor.jpg',30,25,50);
            $this->Ln(50);
        }

        function Footer() {
            $this->SetY(-40);
            
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
            
            $this->Ln(-15);
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
            
            $this->Ln(50);
        }

        function ReceiptData($data, $total, $cep) {
            $this->SetFont('Arial','',13);
            
            for($i=0; $i<count($data); $i++)
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
                
                for($j=0; $j<3; $j++)
                {
                    $this->SetFont('Arial','b',11);
                    $this->Cell(50, 8, $data[$i][$j], 1, 0, 'C', true);
                }
                
                $this->Ln();
            }

            $this->SetFont('Arial','b',20);
            $this->Ln(9);
            
            $this->Cell(63);
            $this->Cell(-9,9,"Preço total da compra: ",0,0,'C');
            $this->Cell(128,9,"R$ $total,00",0,0,'C');

            $this->Ln(15);
            
            $this->Cell(65);
            $this->Cell(-17,9,"Endereço de Entrega: ",0,0,'C');
            $this->Cell(135,9,"$cep",0,0,'C');
        }
    }

    /*----------------------------------------------------------------------------*/

    

    pg_close($conecta);

    /*--------------------------------------------------------------------------------------------*/

    $table1 = ['Nome do produto', 'Quantidade', 'Porcentagem'];
    $table2 = ['Data', 'Vendas(%)', 'Faturamento'];
    $table3 = ['Faixa etária', 'Produto', 'Compras'];
    $table4 = ['Gênero', 'Compras', 'Porcentagem'];

    //PDF Initialization
    $pdf = new PDF();
    $pdf->AliasNbPages();

    //Intro
    $pdf->AddPage();
        $pdf->Title();
        $pdf->ReceiptHeader($table1, 'Quantidade e porcentagem de vendas de todos os produtos.');
        //$pdf->ReceiptData($dadosCompra, $precototal, $cep);
        $pdf->ReceiptHeader($table2, 'Porcentagem e faturamento de vendas por data.');
        //$pdf->ReceiptData($dadosCompra, $precototal, $cep);
        $pdf->ReceiptHeader($table3, 'Produtos mais vendidos por faixa etária.');
        //$pdf->ReceiptData($dadosCompra, $precototal, $cep);
        $pdf->ReceiptHeader($table4, 'Preferência de compra por gênero.');
        //$pdf->ReceiptData($dadosCompra, $precototal, $cep);

    //Show
    $pdf->Output('I', 'Relatorio_vendas.pdf');
?>