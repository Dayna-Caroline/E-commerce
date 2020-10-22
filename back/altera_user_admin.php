<?php
    include "../back/conexao.php";

    $id_user=$_GET['id_usuario'];
    
    

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];

    $sexo_ext = $_POST['sexo'];
    
    if($sexo_ext == 'Feminino' || $sexo_ext == 'feminino'){
        $sexo = 'F';
    }
    else if($sexo_ext == 'Masculino' || $sexo_ext == 'masculino'){
        $sexo = 'M';
    }
    else{
        echo '<script language="javascript">';
        echo "alert('Erro: Erro na alteração do sexo!')";
        echo '</script>';
    }

    $usuario_ext = $_POST['usuario'];
    
    if($usuario_ext == 'Administrador' || $usuario_ext == 'administrador'){
        $usuario = true;
    }
    else if($usuario_ext == 'Cliente' || $usuario_ext == 'cliente'){
        $usuario = false;
    }
    else{
        echo '<script language="javascript">';
        echo "alert('Erro: Erro na alteração do tipo de usuário!')";
        echo '</script>';
    }

    $data_nascimento = $_POST['data'];
    $cpf = $_POST['cpf'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senhaForca'];
    $confirma_senha = $_POST['confirma_senha'];
    
    if($senha != $confirma_senha)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: senhas diferentes!')";
        echo '</script>';
    }
    else if(strlen($cpf) != 14)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: cpf incorreto!')";
        echo '</script>';
    }
    else if(strlen($cep) != 10)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: cep incorreto!')";
        echo '</script>';
    }
    else if(strlen($telefone) != 15)
    {
        echo '<script language="javascript">';
        echo "alert('Erro: telefone incorreto! ((ddd) xxxxx-xxxx)')";
        echo '</script>';
    }
    else
    {
        $se = base64_encode($senha);
        
        $sql = "UPDATE usuario SET nome='$nome', sobrenome='$sobrenome', sexo='$sexo', data_nascimento='$data_nascimento', cpf='$cpf', cep='$cep', telefone='$telefone', email='$logado', senha='$se', adm='$usuario' WHERE id_user='$id_user';";
        $resultado = pg_query($conecta, $sql);
        $linhas = pg_affected_rows($resultado);

        if($linhas > 0)
        {

            header("Location: ../front/users_admin.php");
        }
        else	
        {
            echo '<script language="javascript">';
            echo "alert('Não foi possível alterar as informações!')";
            echo '</script>';
        }
    }
?>