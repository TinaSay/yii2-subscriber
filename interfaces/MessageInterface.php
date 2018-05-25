<?php

namespace tina\subscriber\interfaces;

use tina\subscriber\models\Subscriber;
use yii\mail\MailerInterface;

/**
 * Interface MessageInterface
 *
 * @package tina\subscriber\interfaces
 */
interface MessageInterface
{
    /**
     * MessageInterface constructor.
     *
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer);

    /**
     * @param Subscriber $model
     *
     * @return mixed
     */
    public function send(Subscriber $model);
}
