<?php

namespace Maltz\Sys\Service;

use Maltz\Mvc\View;

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
    protected $view;
    protected $message;
    protected $mailer;

    /**
     * /
     * @param [type] $view [description]
     */
    public function __construct($view)
    {
        $transport = \Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
        $this->mailer = \Swift_Mailer::newInstance($transport);
    }

    /**
     * /
     * @param  [type] $senderEmail [description]
     * @param  [type] $senderName  [description]
     * @param  [type] $subject     [description]
     * @param  [type] $body        [description]
     * @return [type]              [description]
     */
    public function createMessage($senderEmail, $senderName, $subject, $body)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom(array($senderEmail => $senderName))
            ->setBody($body);
        $this->message = $message;
        return $this;
    }

    /**
     * /
     * @param  [type] $recipientEmail [description]
     * @param  [type] $recipientName  [description]
     * @return [type]                 [description]
     */
    public function send($recipientEmail, $recipientName)
    {
        $this->message->setTo(array($recipientEmail => $recipientName));
        return $this->mailer->send($this->message);
    }
}
