<?php
    include "conexao.php";

    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    $logado = null;

    session_start();

    if(isset($_SESSION['email']))
    {
        $logado = $_SESSION['email'];
        $id_user = $_SESSION['id_user'];
    }

    $sql = "SELECT c.id_user, c.id_produto, c.quantidade, c.excluido, p.id_produto, p.produto, p.preco
            FROM carrinho AS c JOIN produto AS p ON c.id_produto = p.id_produto 
            WHERE c.id_user = $id_user AND c.excluido = FALSE;";                            
    $resultado = pg_query($conecta, $sql);
    $qtde = pg_num_rows($resultado);

    if($qtde > 0)
    {
        $sucesso = true;

        //SALVAR COMPRA
        $date = date("Y/m/d");
        $sql = "INSERT INTO compra VALUES(DEFAULT, $id_user, '$date', FALSE);";
        $res = pg_query($conecta, $sql);
        $qtd = pg_affected_rows($res);
        if($qtd == 0)
        {
            $sucesso = false;
            echo "erro ao efetuar compra aqui! 1";
        }
        
        //PEGAR ID DA COMPRA
        $sql = "SELECT * from compra WHERE id_user = $id_user ORDER BY id_compra DESC;";
        $res = pg_query($conecta, $sql);
        $qtd = pg_num_rows($res);
        if($qtd > 0)
        {
            $linha_2 = pg_fetch_array($res);
            $id_compra = $linha_2['id_compra'];
        }
        
        //CRIAR ITENS COMPRA
        while($linha = pg_fetch_array($resultado)) 
        {
            $id_prod = $linha['id_produto'];
            $qtd_prod = $linha['quantidade'];

            $sql = "INSERT INTO itens VALUES(DEFAULT, $id_compra, $id_prod, $qtd_prod);";
            $res = pg_query($conecta, $sql);
            $qtd = pg_affected_rows($res);
            if($qtd == 0)
            {
                $sucesso = false;
                echo "erro ao efetuar compra aqui! 2";
                break;
            }
        }

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

        //DAR BAIXA NO ESTOQUE
        $sql = "SELECT c.id_user, c.id_produto, c.quantidade, c.excluido, p.id_produto, p.produto, p.preco
                FROM carrinho AS c JOIN produto AS p ON c.id_produto = p.id_produto 
                WHERE c.id_user = $id_user AND c.excluido = FALSE;";                            
        $resultado = pg_query($conecta, $sql);
        $qtde = pg_num_rows($resultado);
        if($qtde > 0)
        {
            while($linha = pg_fetch_array($resultado))
            {
                $id_prod = $linha['id_produto'];
                $qtd_prod = $linha['quantidade'];

                $sql = "SELECT quantidade FROM produto WHERE id_produto=$id_prod;";
                $res = pg_query($conecta, $sql);
                $qtd = pg_num_rows($res);
                if($qtd == 0)
                {
                    $sucesso = false;
                    echo "erro ao efetuar compra aqui! 4";
                    break;
                }
                $linha_3 = pg_fetch_array($res);
                $qtd_estoque = $linha_3['quantidade'];

                $qtd_final = $qtd_estoque - $qtd_prod;

                $sql = "UPDATE produto SET quantidade=$qtd_final WHERE id_produto=$id_prod;";
                $res = pg_query($conecta, $sql);
                $qtd = pg_affected_rows($res);
                if($qtd == 0)
                {
                    $sucesso = false;
                    echo "erro ao efetuar compra aqui! 5";
                    break;
                }
            }
        }

        //ESVAZIAR CARRINHO
        $sql = "DELETE FROM carrinho WHERE id_user=$id_user;";
        $res = pg_query($conecta, $sql);
        $qtd = pg_affected_rows($res);
        if($qtd == 0)
        {
            $sucesso = false;
            echo "erro ao efetuar compra aqui! 3";
        }

        if($sucesso == true)
        {
            header("Location: ./gerar_pdf.php");
        }
        else
        {
            echo '<script language="javascript">';
            echo "alert('Erro ao efetuar compra!')";
            echo '</script>';
        }
    }
    else
    {
        echo '<script language="javascript">';
        echo "alert('Erro ao efetuar compra!')";
        echo '</script>';
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

    //ENVIA EMAIL   
            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ecommerce.grupo6@gmail.com';
                $mail->Password = 'jovita123';
                $mail->Port = 587;

                $mail->setFrom('ecommerce.grupo6@gmail.com');
                $mail->addAddress($logado);


                $mail->isHTML(true);
                $mail->Subject = 'Confirmar sua compra Cup&Mug';
                $mail->Body = 'Sua compra no valor de R$'.$precototal.',00 foi bem sucedida e será entregue no endereço do CEP: '.$cep;
                $mail->AltBody = 'Sua compra no valor de '.$precototal.',00 reais foi bem sucedida e será entregue no endereço do CEP: '.$cep;

                if($mail->send()) {
                    echo 'Email enviado com sucesso';
                } else {
                    echo 'Email nao enviado';
                }
            } catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
            }
?>

