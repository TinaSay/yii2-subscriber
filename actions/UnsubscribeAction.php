<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 28.04.18
 * Time: 11:28
 */

namespace tina\subscriber\actions;

use yii\base\Action;
use tina\subscriber\models\Subscriber;

/**
 * Class UnsubscribeAction
 *
 * @package tina\subscriber\actions
 */
class UnsubscribeAction extends Action
{
    /**
     * @param $token
     *
     * @return array|string
     */
    public function run($token)
    {
        $model = Subscriber::find()->where(['token' => $token])->one();
        $model->active = $model::ACTIVE_NO;
        if ($model->save()) {
            return $this->controller->renderContent('Вы отписаны!');
        } else {
            return ['success' => false, 'errors' => $model->getErrors()];
        }
    }
}