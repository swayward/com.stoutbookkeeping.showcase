<?php
include_once '../stout/smtpcred.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

class email extends smtp_creds {

    function cleanArray($incoming_array) {
        
        $clean = [];
        
        if ($incoming_array['company']) {
            if(!empty($incoming_array['company'])) {
                $company = str_replace("\n.", "\n..", $incoming_array['company']);
                $company = 'at ' . $company;
                $clean['company'] = $company;
            }
        }
        
        if ($incoming_array['honorName'] || $incoming_array['firstName'] || $incoming_array['lastName']) {
            $fullName = '';
            if(!empty($incoming_array['honorName'])) {
                $honorName = str_replace("\n.", "\n..", $incoming_array['honorName']);
                $fullName = $honorName . ' ';
            }
            if(!empty($incoming_array['firstName'])) {
                $firstName = str_replace("\n.", "\n..", $incoming_array['firstName']);
                $fullName .= $firstName . ' ';
            }
            if(!empty($incoming_array['lastName'])) {
                $lastName = str_replace("\n.", "\n..", $incoming_array['lastName']);
                $fullName .= $lastName;
            }
            $clean['fullName'] = $fullName;
        }
        
        if ($incoming_array['phone']) {
            $phone = str_replace("\n.", "\n..", $incoming_array['phone']);
            $clean['phone'] = $phone;
        }
        
        if ($incoming_array['hear']) {
            $hear = str_replace("\n.", "\n..", $incoming_array['hear']);
            $clean['hear'] = "How they heard about you: " . $hear;
        }
        
        if ($incoming_array['email']) {
            $email = str_replace("\n.", "\n..", $incoming_array['email']);
            $clean['email'] = $email;
        }
        
        if ($incoming_array['subject']) {
            $subject = str_replace("\n.", "\n..", $incoming_array['subject']);
            $clean['subject'] = "Subject: " . $subject;
        }
        
        if ($incoming_array['message']) {
            $message = str_replace("\n.", "\n..", $incoming_array['message']);
            $message = wordwrap($message, 70, "\r\n");
            $clean['message'] = "Message: <br>" . $message;
        }
        
        if ($incoming_array['contact']) {
            $contact = str_replace("\n.", "\n..", $incoming_array['contact']);
            $clean['contact'] = 'They would like you to respond via ' . $contact;
        }
        
        //debug values
        if($this->debug === TRUE) {
            $this->debug_class->write_debug2("Clean Array Output: ", $clean);
        }
        
        return $clean;
    }
    
    
    function build_stout_email($array) {
        
        $message = '';
        $message = "Tammy,<br><br>You have received an email from:<br><br>" . $array['fullName'];
        
        
        if(!empty($array['company'])) {
            $message .= "<br>" . $array['company'];
        }
        if(!empty($array['phone'])) {
            $message .= "<br>" . $array['phone'];
        }
        if(!empty($array['email'])) {
            $message .= "<br>" . $array['email'];
        }
        if(!empty($array['contact'])) {
            $message .= "<br><br>" . $array['contact'];
        }
        if(!empty($array['subject'])) {
            $message .= "<br><br>" . $array['subject'];
        }
        if(!empty($array['message'])) {
            $message .= "<br>" . $array['message'];
        }
        if(!empty($array['hear'])) {
            $message .= "<br><br>" . $array['hear'];
        }
        
        //debug values
        if($this->debug === TRUE) {
            $this->debug_class->write_debug2("Build Stout Email Message: <br>", $message);
        }
        
        return $message;
    }
    
    
    function send_to_tammy($message) {
        
        // use PHPMailer to send the email
        //Create an instance; passing `true` enables exceptions
        $new_phpmailer = new PHPMailer($this->debug);
        
        try {
            
            //Server settings
            $new_phpmailer->SMTPDebug = 2;
            $new_phpmailer->isSMTP();
            $new_phpmailer->Host = $this->Host;
            $new_phpmailer->SMTPAuth = true;
            #$new_phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $new_phpmailer->SMTPSecure = false;
            $new_phpmailer->SMTPAutoTLS = false;
            
            $new_phpmailer->Port = $this->Port;
            $new_phpmailer->Username = $this->Username;
            $new_phpmailer->Password = $this->Password;

            //Recipients
            $new_phpmailer->setFrom($this->from_email, $this->from_name);
            $new_phpmailer->addAddress($this->to_email, $this->to_name);
            $new_phpmailer->addReplyTo($this->from_email, $this->from_name);
            
            //Content
            $new_phpmailer->isHTML(true);
            $new_phpmailer->Subject = $this->Subject;
            $new_phpmailer->Body = $message;
            $new_phpmailer->AltBody = $message;
        
            //send email
            $new_phpmailer->send();
            
            if($this->debug === TRUE) {
                $this->debug_class->write_debug2("Mailer Error: <br>", "message sent successfully");
            }
            
        } catch (Exception $e) {
            if($this->debug === TRUE) {
                $this->debug_class->write_debug2("Mailer Error: <br>", $new_phpmailer->ErrorInfo);
            }
        }
            
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        


 

    
    function build_client_email($array) {
        $message = '';
        return $message;
    }

    function build_stout_email_html() {
        
    }
    
    function build_client_email_html() {
        
        $client_email = <<<EOF
<html>
    <head>
        <title>Email From Stout Bookkeeping</title>
    <head>
    <body>
        <div style="">
            <img 
        </div>

    </body>
</html>

EOF;
        return $client_email;  
    }
    
} //END Class

?>