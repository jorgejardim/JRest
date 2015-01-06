<?php
namespace Mail;

use \Nette\Mail\Message;
use \Nette\Mail\SmtpMailer;

class Mail extends \Nette\Mail\Message {

    private $mailer;

    public function __construct() {

        parent::__construct();

        $this->mailer = new \Nette\Mail\SmtpMailer(array(
            'host'     => EMAIL_HOST,
            'username' => EMAIL_USER,
            'password' => EMAIL_PASSWORD,
            'port'     => EMAIL_PORT,
            'secure'   => EMAIL_SECURE
        ));

        $this->setFrom(EMAIL_FROM);
    }

    public function send() {

        $this->mailer->send($this);
    }
}