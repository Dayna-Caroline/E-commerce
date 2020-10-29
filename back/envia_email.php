<?php
    include "conexao.php";

    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $email = $_POST['email'];

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = pg_query($conecta, $sql);
    $linhas=pg_num_rows($resultado);
    $linha=pg_fetch_array($resultado);

    if($linhas == 1)
    {
        $se = $linha['senha'];
        $senha = base64_decode($se);

        $mail = new PHPMailer(true);
        // Define que a mensagem poderá ter formatação HTML
        $mail->IsHTML(true);
        // Define que a codificação do conteúdo da mensagem será utf-8
        $mail->CharSet = "utf-8";
        // Define que os emails enviadas utilizarão SMTP Seguro tls
        $mail->SMTPSecure = "tls"; 

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ecommerce.grupo6@gmail.com';
            $mail->Password = 'jovita123';
            $mail->Port = 587;

            $mail->setFrom('ecommerce.grupo6@gmail.com');
            $mail->addAddress($email);

            $mail->AddEmbeddedImage('../imgs/tudo/melhor.jpg', 'logo_ref');
            $mail->isHTML(true);
            $mail->Subject = 'Recupere sua senha Cup&Mug';
            $mail->Body = "<img src='cid:logo_ref' alt='' width='100px' heigth='100px'>"; 
            $mail->Body .= '<h3>Sua senha é: <strong>'.$senha.'</strong></h3>';
            $mail->Body .= "Sugerimos que após a entrada você altere sua senha.";
            $mail->AltBody = 'Sua senha é: '.$senha;

            if($mail->send()) {
                echo 'Email enviado com sucesso';
                ?><meta http-equiv="refresh" content="0; URL='../front/mensagem_email.php'"/><?php
            } else {
                echo 'Email nao enviado';
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    }
    else
    {
        echo "email não encontrado";
    }
?>