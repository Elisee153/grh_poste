<?php

    /**

     * author: Elisee

     * generated at: 19:33

     * date: today

     * licence: MTL

     */

    use PHPMailer\PHPMailer\PHPMailer;

    use PHPMailer\PHPMailer\Exception;



    require_once('PHPMailer/src/Exception.php');

    require_once('PHPMailer/src/PHPMailer.php');

    require_once('PHPMailer/src/SMTP.php');



        /**

        * envoie des mails

        */

        function senderEmail($title_email,$content_email,$emailDestination)
        {
            try {

                $mail = new PHPMailer();

                $mail->isSMTP();

                $mail->SMTPAuth = true;

                $mail->SMTPSecure = 'ssl';

                $mail->Host = 'smtp.gmail.com';

                $mail->Port = '465';

                $mail->isHTML(true);

                $mail->Username = 'elisee.kalonji99@gmail.com';

                $mail->Password = '@elisee2018';

                $mail->SetFrom('elisee.kalonji99@gmail.com');

                $mail->addReplyTo('16kk112@esisalama.org', 'Information');
                
                $mail->Subject = ucfirst($title_email);

                $mail->Body = $content_email;

                $mail->AddAddress($emailDestination);

                $mail->Send();
                
            } catch (Exception $e) {
                // echo "Le Message n'a pas été envoyé. Mailer Error: {$mail->ErrorInfo}"; // Affiche l'erreur concernée le cas échéant 
            }
        }