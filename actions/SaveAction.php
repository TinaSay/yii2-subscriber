<?php

namespace tina\subscriber\actions;

use yii\base\Action;
use tina\subscriber\models\Subscriber;
use Yii;

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
     * @var string
     */
    public $messageView;

    /**
     * @return \yii\web\Response
     */
    public function run()
    {
        $model = new Subscriber();
        if ($model->load(Yii::$app->request->post())) {
            $model->link = Yii::$app->request->getAbsoluteUrl();
            if ($model->save()) {
                $message = \Yii::$app->getMailer()->compose($this->messageView, [
                    'model' => $this,
                ]);
                $message->setSubject('Сообщение с сайта ЭНСАЙН');
                $message->setFrom(Yii::$app->params['email']);
                $message->setTo($model->email);

                $job = \Yii::createObject([
                    'class' => \krok\queue\jobs\MailerJob::class,
                    'message' => $message,
                ]);

                \Yii::$app->get('queue')->push($job);
                return $this->controller->redirect($this->successUrl);
            } else {
                return $this->controller->redirect($this->errorUrl);
            }
        } else {
            return $this->controller->redirect($this->errorUrl);
        }
    }
}