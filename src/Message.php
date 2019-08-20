<?php

namespace tina\subscriber;

use tina\subscriber\interfaces\MessageInterface;
use tina\subscriber\models\Subscriber;
use Yii;
use yii\base\Action;
use yii\mail\MailerInterface;
use yii\mail\MessageInterface as BaseMessageInterface;

/**
 * Class Message
 *
 * @package tina\subscriber
 */
class Message implements MessageInterface
{
    /**
     * @var MailerInterface
     */
    protected $mailer;

    /**
     * Message constructor.
     *
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Subscriber $model
     * @param Action $action
     *
     * @return BaseMessageInterface
     */
    public function make(Subscriber $model, Action $action): BaseMessageInterface
    {
        $message = $this->mailer->compose('@tina/subscriber/mail/subscribe.php', [
            'model' => $model,
        ]);

        $message->setSubject('Сообщение с сайта');
        $message->setFrom(Yii::$app->params['email']);
        $message->setTo($model->email);

        return $message;
    }
}
