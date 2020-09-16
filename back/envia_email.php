<?php
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    include "conexao.php";

    $email = $_POST['email'];

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = pg_query($conecta, $sql);
    $linhas=pg_num_rows($resultado);
    $linha=pg_fetch_array($resultado);

    if($linhas == 1)
    {

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
            $mail->addAddress($email);


            $mail->isHTML(true);
            $mail->Subject = 'Recupere sua senha Cup&Mug';
            $mail->Body = 'Sua senha é: <strong>'.$linha['senha'].'</strong>';
            $mail->AltBody = 'Sua senha é: '.$linha['senha'];

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