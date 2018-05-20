<?php
namespace Mail;

use RevoCMS\RevoCMS;
use Mail\PHPMailer\PhpMailer;

/**
 * Class Mail
 * @package Mail
 * @author iambluedev
 * @copyright RevoCMS.fr | 2017
 */

class Mail extends PhpMailer
{

    /**
     * From Email
     *
     * @var string
     */

    //public $From = 'no-reply@pedophillia.eu';
    // public $FromName;
    //public $Host     = 'smtp.gmail.com';
    //public $Mailer   = 'smtp';
    //public $SMTPAuth = true;
    //public $Username = 'email';
    //public $Password = 'password';
    //public $SMTPSecure = 'tls';
    //public $WordWrap = 75;

    /**
     * Mail constructor.
     */

    public function __construct($bool = false)
    {
        parent::__construct();
        $revocms = RevoCMS::getInstance();
        $this->isSMTP();
        $this->Host = "auth.smtp.1and1.fr";
        $this->Port = 25;
        $this->SMTPAuth = true;
        $this->Username = "no-reply@csgo-report.com";
        $this->SMTPSecure = 'tls';
        $this->SMTPDebug  = 0;
        $this->Password = "6xPq6A4y";
        $this->setFrom('no-reply@epicaim.net', 'EpicAim.net');
        $this->addReplyTo('no-reply@epicaim.net', 'EpicAim.net');
        $this->ContentType = 'text/html';
        $this->CharSet = "utf-8";
    }

    /**
     * Set The Subject
     *
     * @param string $subject
     */
    
    public function subject(string $subject)
    {
        $this->Subject = $subject;
    }

    /**
     * Set The Body
     *
     * @param string $body
     */

    public function body(string $body)
    {
        $this->msgHTML($body);
    }

    /**
     * Send Email
     *
     * @return bool
     */

    public function send() : bool
    {
		$this->CharSet = 'UTF-8';
        $this->AltBody = strip_tags(stripslashes($this->Body)) . "\n\n";
        $this->AltBody = str_replace("&nbsp;", "\n\n", $this->AltBody);
        return parent::send();
    }
}
