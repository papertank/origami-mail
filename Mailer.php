<?php namespace Origami\Mail;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

abstract class Mailer {

	public function send($email, $name = null, $subject, $view, $data = [])
	{
		return Mail::queue($view, $data, function($message) use($email, $name, $subject)
		{
			$message->to($email, $name)->subject($subject);
		});
	}

	public function sendTo(MailableInterface $entity, $subject, $view, $data = []) 
	{
		return $this->send($entity->getEmail(), $entity->getEmailName(), $subject, $view, $data);
	}

}