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
            '@tina/subscriber/migrations',
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

...

```
    'modules' => [
        'subscriber' => [
            'class' => \tina\subscriber\Module::class,
            'viewPath' => '@tina/subscriber/views/frontend',
            'controllerNamespace' => 'tina\subscriber\controllers\frontend',
        ],
    ],

```

common:

```
    'definitions' => [
        \tina\subscriber\actions\SaveAction::class => [
            'successUrl' => ['/'],
            'errorUrl' => ['/'],
            'message' => function (\tina\subscriber\models\Subscriber $model, \yii\base\Action $action) {
                $message = Yii::createObject(\tina\subscriber\Message::class);
                return $message->make($model, $action);
            },
        ],
        \tina\subscriber\actions\UnsubscribeAction::class => [
            'successUrl' => ['/'],
            'errorUrl' => ['/'],
        ],
        \tina\subscriber\filter\SubscriberFilterInterface::class=>\tina\subscriber\filter\SubscriberFilter::class,
    ],

```

Use:
----

Example of usage in SubscriberController:

```
    public function actions()
    {
        return [
            'save' => [
                'class' => SaveAction::class,
            ],
            'unsubscribe' => [
                'class' => UnsubscribeAction::class,
            ],
        ];
    }
```

View:

```
<?= \tina\subscriber\widgets\SubscriberWidget::widget(); ?>
```

Use filter:
---

DI:

```
    protected $subscriberFilter;

    public function __construct(SubscriberFilterInterface $subscriberFilter)
    {
        $this->subscriberFilter = $subscriberFilter;
    }
```

To select particular columns use:

```
    $query = $this->subscriberFilter->filter([
        'column' => 'value',
    ]);
    
```

To select particular columns with additional conditions use:

```    
    $query = $this->subscriberFilter->filter([
        'and',
        ['column' => 'value'],
        ['like', 'column', 'value'],
    ]);

```

Message.php - example of MessageInterface Object to be edited as per your message settings 
