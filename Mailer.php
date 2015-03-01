<?php namespace Origami\Mail;

use Illuminate\Contracts\Mail\Mailer as Mail;
use Illuminate\Mail\Message;

abstract class Mailer {

	protected $mail;

	public function __construct(Mail $mail)
	{
		$this->mail = $mail;
	}
	
	public function send($email, $name = null, $subject, $view, $data = [])
	{
		return $this->mail->queue($view, $data, function($message) use($email, $name, $subject)
		{
			$message->to($email, $name)->subject($subject);
		});
	}

	public function sendTo(MailableInterface $entity, $subject, $view, $data = []) 
	{
		return $this->send($entity->getEmail(), $entity->getEmailName(), $subject, $view, $data);
	}

}