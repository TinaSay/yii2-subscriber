<?php

namespace tina\subscriber\actions;

use krok\queue\mailer\MailerJob;
use tina\subscriber\models\Subscriber;
use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\mail\MessageInterface;

/**
 * Class SaveFormAction
 *
 * @package tina\subscriber\actions
 */
class SaveAction extends Action
{
    /**
     * @var string|array
     */
    public $successUrl;

    /**
     * @var string|array
     */
    public $errorUrl;

    /**
     * @var MessageInterface message instance
     */
    public $message;

    /**
     * @return \yii\web\Response
     * @throws InvalidConfigException
     */
    public function run()
    {
        $model = new Subscriber();
        if ($model->load(Yii::$app->request->post())) {
            $model->link = Yii::$app->request->referrer;
            if ($model->save()) {
                if (is_callable($this->message)) {
                    $this->message = call_user_func($this->message, $model, $this);
                }

                if ($this->message instanceof MessageInterface) {
                    $job = Yii::createObject([
                        'class' => MailerJob::class,
                        'message' => $this->message,
                    ]);
                    Yii::$app->get('queue')->push($job);
                } else {
                    throw new InvalidConfigException('Invalid data type: ' . get_class($this->message) . '. ' . MessageInterface::class . ' is expected.');
                }

                return $this->controller->redirect($this->successUrl);
            } else {
                return $this->controller->redirect($this->errorUrl);
            }
        } else {
            return $this->controller->redirect($this->errorUrl);
        }
    }
}
