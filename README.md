Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist contrib/yii2-subscriber "*"
```

or add

```
"contrib/yii2-subscriber": "*"
```

to the require section of your `composer.json` file.

Configure
---------

backend:

```
    'modules' => [
        'subscriber' => [
            'class' => \tina\subscriber\Module::class,
            'viewPath' => '@tina/subscriber/views/backend',
            'controllerNamespace' => 'tina\subscriber\controllers\backend',
        ],
    ],
```

params:

```
    'menu' => [
        [
            'label' => 'Subscriber',
            'items' => [
                [
                    'label' => 'Subscriber',
                    'url' => ['/subscriber/subscriber'],
                ],
                [
                    'label' => 'Subscription Group',
                    'url' => ['/subscriber/subscription-group'],
                ],
            ],

        ],
    ],
```

console:

```
    'migrate' => [
        'class' => \yii\console\controllers\MigrateController::class,
        'migrationTable' => '{{%migration}}',
        'interactive' => false,
        'migrationPath' => [
            '@vendor/contrib/yii2-subscriber/migrations',
        ],
    ],
```
...

```
    'config' => [
        [
            'name' => 'subscriber',
            'controllers' => [
                'subscriber' => [
                    'index',
                    'create',
                    'update',
                    'view',
                    'delete',
                ],
                'subscription-group' => [
                    'index',
                    'create',
                    'update',
                    'view',
                    'delete',
                ],
            ],
        ],
    ],
```
frontend:

```
$config = [
    'on afterRequest' => function () {
        Yii::$app->getResponse()->getHeaders()->add('Content-Security-Policy',
        'script-src 'self' 'unsafe-inline' 'unsafe-eval\' https://api-maps.yandex.ru https://suggest-maps.yandex.ru https://*.maps.yandex.net https://yandex.ru ajax.googleapis.com api-maps.yandex.ru; style-src * blob: \'unsafe-inline\';');
    {
]

```
Use:
----

Controller:

```
    public function actions()
    {
        return [
            'save-form' => [
                'class' => SaveFormAction::class,
                'successUrl' => ['index'],
                'errorUrl' => ['index'],
            ],
        ];
    }
```

```
<?= SubscriberWidget::widget(); ?>

```