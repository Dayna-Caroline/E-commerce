<?php
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

        echo "ID COMPRA = ".$id_compra;
        
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

        //ESVAZIAR CARRINHO
        $sql = "DELETE FROM carrinho WHERE id_user=$id_user;";
        $res = pg_query($conecta, $sql);
        $qtd = pg_affected_rows($res);
        if($qtd == 0)
        {
            $sucesso = false;
            echo "erro ao efetuar compra aqui! 3";
        }

        //DAR BAIXA NO ESTOQUE
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

        if($sucesso == true)
            header("Location: ./gerar_pdf.php");
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
