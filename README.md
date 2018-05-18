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
$config = [
    'on afterRequest' => function () {
        Yii::$app->getResponse()->getHeaders()->add('Content-Security-Policy',
        'script-src * 'self' 'unsafe-inline' 'unsafe-eval';connect-src * 'self' speller.yandex.net;child-src * 'self';style-src * blob: 'unsafe-inline';');
    }
]

```
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
        'script-src * 'self' 'unsafe-inline'; style-src * blob: 'unsafe-inline';');
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
                'class' => tina\subscriber\actions\SaveFormAction::class,
                'successUrl' => ['index'],
                'errorUrl' => ['index'],
            ],
            'unsubscribe' => [
                'class' => tina\subscriber\actions\UnsubscribeAction::class,
            ],
        ];
    }
```
View:

```
<?= tina\subscriber\widgets\SubscriberWidget::widget(); ?>

```
Use filter:
---

Controller:

```
    $subscriberFilter = new SubscriberFilter();

    $query = $subscriberFilter->filter([
        ['column' => 'value'],
    ]);
    
    // or operator format
    
    $query = $subscriberFilter->filter([
        'and',
        ['column' => 'value'],
        ['like', 'column', 'value'],
    ]);    
    
```

