<?php 
/** 
* EmailManager
* This class is responsible to send emails.
*/
require_once(__DIR__."/../includes/passwords.inc.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailManager{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();

        $this->mail->SMTPDebug = 0;

        $this->mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
        //Ask for HTML-friendly debug output
        $this->mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Mailer='smtp';
        $this->mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $this->mail->Username = "ziqcompanyteam@gmail.com";

        //Password to use for SMTP authentication
        $this->mail->Password = E_PASSWORD;

        //Set who the message is to be sent from
        $this->mail->setFrom('ziqcompanyteam@gmail.com', 'ZiQ - Faster Order, Convenient pickup');

    }

    /**
     * Saves an email. 
     */
    public function save_mail($mail) {
        //You can change 'Sent Mail' to any other folder or tag
        $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

        //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
        $imapStream = imap_open($path, $mail->Username, $mail->Password);

        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);

        return $result;
    }

     /**
         * @param string $recName - full name of the receiver
         * @param string $email - email of the receiver
         * @param string $sub - subject of the email
         * @param string $msg - HTML message to send
         * @param bool|string $attachement - link to attachment or false if none
         * @param bool|string $replyTo - set reply to email or false if none
         * @return bool
         */
    public function sendEmail($recName, $recEmail, $sub, $msg, $attachment = false, $replyTo = false){
        $this->mail->addAddress($recEmail, $recName);
        $this->mail->Subject = $sub;
        if($replyTo !== false && !preg_match('/^\s*$/', $replyTo)){
            $this->mail->addReplyTo($replyTo);
        }
        $this->mail->msgHTML($msg);

        $this->mail->AltBody = $this->mail->html2text($msg);
        if($attachment !== false && !preg_match('/^\s*$/', $attachment)){
            $this->mail->addAttachment($attachment);
        }
        
        if($this->mail->send()){
            return true;
        }else{
            return false;
        }
    }


}

?>
      