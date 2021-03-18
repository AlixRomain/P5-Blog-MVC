<?php


namespace App\Controller\Globals;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailerController
{
    public function __construct()
    {
        require_once('../config/dataMail.php');
    }
    /**
     * @param array $user
     * @return int
     */
    public function sendContactEmail(array $dataPost)
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport(MAIL_SMTP, MAIL_PORT, 'ssl'))
            ->setUsername(MAIL_USERNAME)
            ->setPassword(MAIL_PASSWORD);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Contact du blog de Romain'))
            ->setFrom([$dataPost['email'] => $dataPost['firstName'].' '.$dataPost['lastName']])
            ->setTo(MAIL_USERNAME)
            ->setBody($dataPost['content']);

        // Send the message
        $result = $mailer->send($message);
        return $result;
    }
}