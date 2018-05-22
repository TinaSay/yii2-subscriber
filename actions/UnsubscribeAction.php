<?php

namespace tina\subscriber\actions;

use yii\base\Action;
use tina\subscriber\models\Subscriber;
use yii\web\NotFoundHttpException;

/**
 * Class UnsubscribeAction
 *
 * @package tina\subscriber\actions
 */
class UnsubscribeAction extends Action
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
     * @param $token
     *
     * @return array|string
     * @throws NotFoundHttpException
     */
    public function run($token)
    {
        $model = Subscriber::find()->where(['token' => $token])->one();
        if ($model == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->active = $model::ACTIVE_NO;
        if ($model->save()) {
            return $this->controller->redirect($this->successUrl);
        } else {
            return $this->controller->redirect($this->errorUrl);
        }
    }
}