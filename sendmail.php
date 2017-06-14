 <?php
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Asia/Bangkok');

require 'PHPMailer/PHPMailerAutoload.php';
require 'forgot_pass.php';
//Create a new PHPMailer instance
$mail->CharSet = 'UTF-8';
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "smtp.gmail.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = 'pee.developer@gmail.com';
//Password to use for SMTP authentication
$mail->Password = "tryurt8tt";
//Set who the message is to be sent from
$mail->setFrom('pee.developer@gmail.com', 'Peerawat Boonsaen');
//Set who the message is to be sent to
$mail->addAddress($email);
//Set the subject line
$mail->Subject = "กู้รหัสผ่าน (กรมราชทัณฑ์)";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('content.html'), dirname(__FILE__));
$mail->msgHTML("เมื่อได้รับรหัสผ่านแล้วคุณสามารถ Login ได้ทันที และเปลี่ยนรหัสผ่านได้ที่หน้าตั้งค่า <br /> รหัสประจำตัวประชาชน :".$id."<br/> รหัสผ่าน :".$password);

if(!$result){
	$results = '{"results":"Mail not found"}';
	echo $results;
}
else{
		//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	    $results = '{"results":"Mail Error"}';
	    echo $results;
	} else {
		mysql_query($update);//update password
	    $results = '{"results":"Mail sending"}';
	    echo $results;
	}

}

