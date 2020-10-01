<?php
    require("./fpdf/fpdf.php");

    class PDF extends FPDF
    {
        function Header() {
            $this->Image('../imgs/tudo/melhor.jpg',30,25,50);
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

        function Title($date, $id) {

            $this->SetFont('Arial','b',24);
            
            $this->Ln(40);
            $this->Cell(20);
            $this->Cell(150,15,"Comprovante de Compra",1,50,'C');
           
            $this->SetFont('Arial','b',20);
            $this->Ln(15);
            
            $this->Cell(48.5);
            $this->Cell(7,9,"Código da compra: ",0,0,'C');
            $this->Cell(79,9,"0$id",0,0,'C');

            $this->Ln(15);

            $this->Cell(56);
            $this->Cell(-16,9,"Data da compra: ",0,0,'C');
            $this->Cell(117,9,date_format(new DateTime($date), 'd/m/Y')."",0,0,'C');
            
            $this->Ln(15);

            $this->Cell(45);
            $this->Cell(20,9,"Produtos da compra:",0,0,'C');

            $this->Ln(10);
        }
        
        function ReceiptHeader($header) {
            $this->SetFont('Arial','b',16);

            $this->SetFillColor(255,255,255);
            $this->Cell(20, 8, "", 0, 0, 'C', true);
            
            // Header
            $this->SetFillColor(255,60,60);

            foreach($header as $column)
                $this->Cell(50, 8, $column, 1, 0, 'C', true);
            
            $this->Ln(8);
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

    session_start();
    
    if(!isset($_SESSION['email']))
        return;

    $id_user = $_SESSION['id_user'];

    include("./conexao.php");

    //Dados da Compra 
    $sql = "SELECT * from compra WHERE id_user = $id_user ORDER BY id_compra DESC";
    $resultado = pg_query($conecta, $sql);
    $qtde = pg_num_rows($resultado);

    if($qtde < 0) {
        return;
    }

    $linha = pg_fetch_array($resultado);

    $idCompra = $linha['id_compra'];
    $dataCompra = $linha['data_compra'];

    //Dados Itens
    $sql2 = "SELECT compra.id_compra, produto.produto, itens.quantidade, produto.preco, produto.imagem 
             FROM itens JOIN compra ON itens.id_compra=compra.id_compra
             INNER JOIN produto ON itens.id_produto=produto.id_produto
             WHERE id_user=$id_user AND compra.id_compra=$idCompra ORDER BY data_compra";
    $resultado2 = pg_query($conecta, $sql2);
    $qtde2 = pg_num_rows($resultado2);

    if($qtde2 < 0) {
        return;
    }
    
    $i = 0;
    $precototal = 0;

    while($linha2 = pg_fetch_array($resultado2))
    {
        $produto = $linha2['produto'];
        $quantidade = $linha2['quantidade'];
        $preco = $linha2['preco'];

        $precofinal = $preco*$quantidade;
        $precototal += $precofinal;

        if($i == 0) {
            $dadosCompra = array(array("$produto", "$quantidade", "$precofinal"));
        } else {
            array_push($dadosCompra, array("$produto", "$quantidade", "$precofinal"));
        }

        $i++;
    }

    //Dados Cliente
    $sql3 = "SELECT cep from usuario WHERE id_user = $id_user";
    $resultado3 = pg_query($conecta, $sql3);
    $qtde3 = pg_num_rows($resultado3);

    if($qtde3 < 0) {
        return;
    }

    $linha3 = pg_fetch_array($resultado3);

    $cep = $linha3['cep'];

    pg_close($conecta);

    /*--------------------------------------------------------------------------------------------*/

    $tableHeader = ['Nome do produto', 'Quantidade', 'Preço (R$)'];

    //PDF Initialization
    $pdf = new PDF();
    $pdf->AliasNbPages();

    //Intro
    $pdf->AddPage();
        $pdf->Title($dataCompra, $idCompra);
        $pdf->ReceiptHeader($tableHeader);
        $pdf->ReceiptData($dadosCompra, $precototal, $cep);

    //Show
    $pdf->Output('I', 'Comprovante_compra.pdf');
?>