<?php

namespace app\helpers;

use app\models\Config;
use Yii;
use Exception;

/**
 * MailHelper provides additional mail functionality.
 */
class MailHelper
{
	/**
	 * Sends mail
	 * 
	 * @param array $params
	 *     - to (required)      where to send email to
	 *     - subject (required) subject of email
	 *     - view (required)    view to render mail content
	 *     - viewParams         parameters (name-value pairs) that will be extracted and made available in the view file
	 *     - from
	 *     - cc
	 *     - replyTo
	 *     - attachments
	 * @throws Exception
	 * @return boolean
	 */
	public static function sendMail($params)
	{
		$from = empty($params['from']) ? [Config::getEmailNoReply() => Yii::$app->name] : $params['from'];
		$replyTo = empty($params['replyTo']) ? Config::getEmailNoReply() : $params['replyTo'];

		if (!isset($params['to'])) {
			throw new Exception("Missing parameter : to");
		}
		$to = $params['to'];

		if (!isset($params['subject'])) {
			throw new Exception("Missing parameter : subject");
		}
		$subject = $params['subject'];

		if (!isset($params['view'])) {
			throw new Exception("Missing parameter : view");
		}
		$view = $params['view'];

		if (!isset($params['viewParams'])) {
			$params['viewParams'] = [];
		}
		$paramsView = $params['viewParams'];

		if (!isset($params['attachments'])) {
			$params['attachments'] = [];
		}
		$attachments = $params['attachments'];

		if (!isset($params['cc'])) {
			$params['cc'] = [];
		}
		$cc = $params['cc'];

		$mail = Yii::$app->mailer
			->compose($view, $paramsView)
			->setFrom($from)
			->setTo($to)
			->setCc($cc)
			->setReplyTo($replyTo)
			->setSubject($subject);

		foreach ($attachments as $attachment) {
			$mail->attach($attachment);
		}

		$sent = $mail->send();

		self::clearMailer();

		return $sent;
	}

	/**
	 * - clear all recipients [clear to and cc]
	 * - clear attachments
	 */
	public static function clearMailer()
	{
		Yii::$app->mailer->adapter->clearAllRecipients();
		Yii::$app->mailer->adapter->clearReplyTos();
		Yii::$app->mailer->adapter->clearAttachments();
	}
}