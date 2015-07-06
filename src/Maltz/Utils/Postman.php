<?php

namespace Maltz\Utils;

use Swift\Swift_Mailer;
use Swift\Swift_Message;
use Swift\Swift_SendmailTransport;

/*
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
 *
 * @version    0.1 alpha
 */

class Postman
{
    protected $message;
    protected $mailer;

    /*
     *
     */
    public function __construct()
    {
        $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
        $this->mailer = Swift_Mailer::newInstance($transport);
    }

    /*
     *
     */
    public function createMessage($senderEmail, $senderName, $subject, $body)
    {
        $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom(array($senderEmail => $senderName))
            ->setBody($body);
        $this->message = $message;
        return $this;
    }

    /*
     *
     */
    public function send($recipientEmail, $recipientName)
    {
        $this->message->setTo(array($recipientEmail => $recipientName));
        $this->mailer->send($this->message);
        return $this;
    }
}
