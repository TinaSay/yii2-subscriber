<?php

/* @var $model \tina\subscriber\models\Subscriber */

use yii\helpers\Url;
?>
<h3>Здравствуйте!</h3>

<p><?= $model->email ?>, благодарим за подписку!</p>
<p><a href="<?= Url::to(['unsubscribe', 'token' => $model->token]) ?>">Отписаться от рассылки!</a></p>

<p>С уважением,
    почтовый робот N.</p>