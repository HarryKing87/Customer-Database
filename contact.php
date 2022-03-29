<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require_once 'vendor/autoload.php';
 
$mail = new PHPMailer(true);


$mail->isSMTP();
$mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'harrykinghsv@gmail.com'; //gmail SMTP server//username
$mail->Password = 'Babis1996!';   //password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465; 

$mail->setFrom('harrykinghsv@gmail.com', 'Charalampos');
$mail->addAddress($_POST[], 'Test User');
 
$mail->isHTML(true);
 
$mail->Subject = 'Email subject';
$mail->Body    = '<div>
<h1>Hey!</h1>
<p>Thank you so much for adding yourself to this valuable newsletter. I, coding_harry welcome you
to this newsletter. I hope you enjoy it.</p>

<p><i>Have a great day!</i></p>
<p>Yours, Harry</p>
</div>';
 
$mail->send();
echo '<script>alert("Successfully Subscribed!")</script>';
echo "<script>window.open('index.php','_self')</script>";  
?>