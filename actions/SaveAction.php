<?php

namespace tina\subscriber\actions;

use Closure;
use krok\queue\jobs\MailerJob;
use tina\subscriber\models\Subscriber;
use Yii;
use yii\base\Action;
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
     */
    public function run()
    {
        $model = new Subscriber();
        if ($model->load(Yii::$app->request->post())) {
            $model->link = Yii::$app->request->referrer;
            if ($model->save()) {
                if ($this->message instanceof Closure) {
                    $this->message = call_user_func($this->message, $model);
                }
                $job = Yii::createObject([
                    'class' => MailerJob::class,
                    'message' => $this->message,
                ]);
                Yii::$app->get('queue')->push($job);
                return $this->controller->redirect($this->successUrl);
            } else {
                return $this->controller->redirect($this->errorUrl);
            }
        } else {
            return $this->controller->redirect($this->errorUrl);
        }
    }
}