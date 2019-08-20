<?php

namespace tina\subscriber\actions;

use tina\subscriber\models\Subscriber;
use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
     * @param string $token
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function run(string $token)
    {
        $model = Subscriber::find()->where(['token' => $token])->one();

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->active = Subscriber::ACTIVE_NO;

        if ($model->save()) {
            return $this->controller->redirect($this->successUrl);
        } else {
            return $this->controller->redirect($this->errorUrl);
        }
    }
}
