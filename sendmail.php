<?php
    require "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    // require 'PHPMailer/src/Exception.php';
    // require 'PHPMailer/src/PHPMailer.php';
    // require 'PHPMailer/src/SMTP.php';

    require 'credentials.php';

    function send_mail($name,$from,$email,$to, $type,$hodName) {

        $mail = new PHPMailer(true);

        //$mail->SMTPDebug = 4;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL;                 // SMTP username
        $mail->Password = PASS;                           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                           // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom(EMAIL, 'Leave Application');
        $mail->addAddress($email);              // Name is optional
        $mail->addReplyTo(EMAIL);
        
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = " ".$type." Application";
        $mail->Body    = "
            <p></p><br>
            Hi ".$hodName.",  ".$name." has applied<br>
             for ".$type." from ".$from." to ".$to.".<br><br>
            Kindly login into the Leave Application Portal and review.<br>
            THANK YOU.<br><br>";
        $mail->AltBody = 'Leave Application from the Leave Management system';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script>alert('Leave Application was successful.');</script>";
            echo "<script type='text/javascript'> document.location = 'leave_history.php'; </script>";
        }
    }
?>