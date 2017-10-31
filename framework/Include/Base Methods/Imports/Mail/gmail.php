<?php
class php_mailer
{
    public static function check_email($email)
    {


        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function mail_to($sender_gmail,$sender_password,$reciever_email,$email_body,$email_subject="",$alt_body="")
    {
        //if(!i)
        /**
         * This example shows settings to use when sending via Google's Gmail servers.
         */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that

        date_default_timezone_set('Etc/UTC');

        include('PHPMailerAutoload.php');

//Create a new PHPMailer instance
        $mail = new PHPMailer;

//Tell PHPMailer to use SMTP
        $mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
        $mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $sender_gmail;

//Password to use for SMTP authentication
        $mail->Password =$sender_password;

//Set who the message is to be sent from
        $mail->setFrom($sender_gmail, 'Admin');

//Set an alternative reply-to address
        $mail->addReplyTo($sender_gmail, 'Admin');

//Set who the message is to be sent to
        $mail->addAddress($reciever_email,'NEP');

//Set the subject line
        $mail->Subject = $email_subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        $mail->msgHTML($email_body);
//Replace the plain text body with one created manually
        $mail->AltBody = $alt_body;

//Attach an image file
       // $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
        ob_start();

        if (!$mail->send()) {

            
            ob_end_clean();
            return "Mailer Error: " . $mail->ErrorInfo;
        } else {
            ob_end_clean();
            //echo "Message sent!";

            return 1;
        }

    }// end of mail_to function
}

//php_mailer::mail_to('developersanjog@gmail.com',52663);