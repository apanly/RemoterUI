<?php
class mail
{
   private $address=array();
   public function sendMail($subject,$body){
       if(empty($this->address)){
           echo 'Message could not be sent.';
           echo 'Mailer Error: 没有接受人';
           return ;
       }
       $mail = new PHPMailer();
       $mail->Port = 25;
       $mail->IsSMTP();                                      // Set mailer to use SMTP
       $mail->Host = 'smtp.anjuke.com';  // Specify main and backup server
       $mail->SMTPAuth = true;                               // Enable SMTP authentication
       $mail->Username = 'Vincentguo@anjuke.com';                            // SMTP username
       $mail->Password = 'xxxxxx';                           // SMTP password
       //$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
       $mail->CharSet="UTF-8";
       $mail->Encoding = 'base64';
       $mail->From = 'Vincentguo@anjuke.com';
       $mail->FromName = 'Vincentguo';
       foreach($this->address as $item){
           $mail->AddAddress($item[0], $item[1]);  // Add a recipient
       }
       $mail->IsHTML(true);                                  // Set email format to HTML
       $mail->Subject = $subject;
       $mail->Body    = $body;
       if(!$mail->Send()) {
           echo 'Message could not be sent.';
           echo 'Mailer Error: ' . $mail->ErrorInfo;
           exit;
       }
   }

    public function addAddress($email,$nickname=""){
          if($email){
              $this->address[]=array($email,$nickname);
          }
    }


}
