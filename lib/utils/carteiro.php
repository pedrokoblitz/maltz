<?php

/*
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda não tem nome
 *
 * @version    0.1 alpha
 */

class Carteiro
{
	
	/*
	* envia mensagem do formulário de contato
	*
	* @param $assunto string
	* @param $corpo string
	* @param $destino mixed
	*
	*/
	public static function enviar($assunto,$corpo,$destino=false)
	{

		$optEmail = option('email_contato');
		if (!$destino) {
			if (!$optEmail) {$mail = 'r_maltz@yahoo.com';} else {$mail = $optEmail;}
			$destino = array($mail => 'Carteiro do sistema');
		}

		// Sendmail
		$transporte = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
		$carteiro = Swift_Mailer::newInstance($transporte);

		$mensagem = Swift_Message::newInstance()
			->setSubject($assunto)
			->setFrom(array('no-reply@ronymaltz.com' => 'Rony Maltz - Carteiro do Sistema'))
			->setTo($destino)
			->setBody($corpo);

		$carteiro->send($mensagem);
	}
}

?>
