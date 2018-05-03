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
use Yii;

/**
 * Class SaveFormAction
 *
 * @package tina\subscriber\actions
 */
class SaveFormAction extends Action
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
     * @return \yii\web\Response
     */
    public function run()
    {
        $model = new Subscriber();
        if ($model->load(Yii::$app->request->post())) {
            $model->link = Yii::$app->request->getAbsoluteUrl();
            if ($model->save()) {
                return $this->controller->redirect($this->successUrl);
            } else {
                return $this->controller->redirect($this->errorUrl);
            }
        } else {
            return $this->controller->redirect($this->errorUrl);
        }
    }
}