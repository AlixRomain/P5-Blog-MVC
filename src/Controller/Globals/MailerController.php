<?php


namespace App\Controller\Globals;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailerController
{
    public function __construct()
    {
        //require_once('../config/dataMail.php');
        require_once('../config/dataMail2.php');
    }
    /**
     * @param array $dataPost
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
            ->setFrom([$dataPost['email'] => $dataPost['firstName'].' '.$dataPost['lastName'].' '.$dataPost['email']])
            ->setTo(MAIL_USERNAME)
            ->setBody($dataPost['content']);
        // Send the message
        $result = $mailer->send($message);
        return $result;
    }
    /**
     * @param $user object
     * @return int
     */
    public function sendCreateAccountEmail($user)
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport(MAIL_SMTP, MAIL_PORT, 'ssl'))
            ->setUsername(MAIL_USERNAME)
            ->setPassword(MAIL_PASSWORD);
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $token = $user->getToken();
        //http:// si localHost www.
        $link = "http://". filter_input(INPUT_SERVER, 'HTTP_HOST')."/index.php?page=login&method=registerMethod&token=" .$token;
        $content = sprintf('<h1>Bienvenue dans l\'équipe '.$user->getFirstName(). $user->getLastName().'</h1>
							<p>Voici votre nouveau mail d\'activation.</p>
							<p>Pour finaliser votre inscription, 
							veuillez cliquer sur ce lien :</p>
							<p>
							<a 
							href=\''.$link.'\'
							title=\"Activer le compte\">
							J\'active mon compte sur le blog de Romain.
							</a>
							</p>
            ');
        $message = (new Swift_Message('Création de votre comte "Le blog de Romain"'))
            ->setFrom(['blogderoman@blog.com' => 'Romain'.' '.'Alix'])
            ->setTo($user->getEmail())
            ->setBody($content, 'text/html');
        // Send the message
        $result = $mailer->send($message);
        return $result;
    }
    /**
     * @param  $user object
     * @return int
     */
    public function sendNewLinkActivation($user)
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport(MAIL_SMTP, MAIL_PORT, 'ssl'))
            ->setUsername(MAIL_USERNAME)
            ->setPassword(MAIL_PASSWORD);
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $token = $user->getToken();
        //http:// si localHost www.
        $link = "http://". filter_input(INPUT_SERVER, 'HTTP_HOST')."/index.php?page=login&idUser=".$user->getIdUser()."&method=newPassMethod&token=" .$token;
        $content = sprintf('<h1>Enfin de retour parmis nous '.$user->getFirstName(). $user->getLastName().'</h1>
							<p>Voici le lien à cliquer pour réinitialiser votre mot de passe.</p>
							<p>Veuillez cliquer sur ce lien :</p>
							<p>
							<a 
							href=\''.$link.'\'
							title=\"Activer le compte\">
							Je modifie mon mot de passe sur le blog de Romain.
							</a>
							</p>
            ');
        $message = (new Swift_Message('Création de votre comte "Le blog de Romain"'))
            ->setFrom(['blogderomain@blog.com' => 'Romain'.' '.'Alix'])
            ->setTo($user->getEmail())
            ->setBody($content, 'text/html');
        // Send the message
        $result = $mailer->send($message);
        return $result;
    }
}
