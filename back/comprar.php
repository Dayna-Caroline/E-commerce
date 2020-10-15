<?php
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    include "conexao.php";

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
        //PEGA O PREÇO
        $soma_total=0;
        $sql="SELECT c.id_user, c.id_produto, c.quantidade, c.excluido,p.id_produto, p.produto, p.descricao, p.preco, p.imagem FROM carrinho AS c JOIN produto AS p ON c.id_produto = p.id_produto WHERE c.id_user = $id_user AND c.excluido = FALSE;";                       
        $resultado = pg_query($conecta, $sql);
        $qtdeA = pg_num_rows($resultado);

        if($qtdeA > 0)
        {

            for($cont=0; $cont < $qtde; $cont++)
            {
                $linha=pg_fetch_array($resultado);
                $estoque=0;
                for($cont2=0; $cont2 < $linha['quantidade']; $cont2++)
                    $soma_total+=$linha['preco'];

            }
        }
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
            
            //PEGA O CEP
            $cep = 0;
            $sql="SELECT cep FROM usuario WHERE id_user=$id_user;";
            $resultado = pg_query($conecta, $sql);
            $qtdeB = pg_num_rows($resultado);

            if($qtdeB > 0)
            {
                $linha=pg_fetch_array($resultado);

                $cep=$linha['cep'];
            }
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
                $mail->Body = 'Sua compra no valor de '.$soma_total.' reais foi bem sucedida e será entregue no endereço do CEP: '.$cep;
                $mail->AltBody = 'Sua compra no valor de '.$soma_total.' reais foi bem sucedida e será entregue no endereço do CEP: '.$cep;

                if($mail->send()) {
                    echo 'Email enviado com sucesso';
                } else {
                    echo 'Email nao enviado';
                }
            } catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
            }
            ?><meta http-equiv="refresh" content="0; URL='./gerar_pdf.php'"/><?php
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
?>
