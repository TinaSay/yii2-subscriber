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
use yii;

/**
 * Class SaveFormAction
 *
 * @package tina\subscriber\actions
 */
class SaveFormAction extends Action
{
    /**
     * @return string|yii\web\Response
     */
    public function run()
    {
        $model = new Subscriber();
        $model->load(Yii::$app->request->post());
        $model->ip = ip2long($_SERVER['REMOTE_ADDR']);
        $model->link = Yii::$app->request->getAbsoluteUrl();
        $model->save();
        return $this->controller->renderContent('Спасибо за подписку!');
    }
}