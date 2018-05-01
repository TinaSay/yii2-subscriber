<?php

namespace tina\subscriber\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * Class YandexMapAsset
 *
 * @package tina\subscriber\assets
 */
class YandexMapAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@app/extensions/subscriber/assets/dist';

    /**
     * @var array
     */
    public $js = [
        'https://api-maps.yandex.ru/2.1/?lang=ru_RU&csp=true',
        'js/yandexMap.js',
    ];

    /**
     * @var array
     */
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

    /**
     * @var array
     */
    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV,
    ];

    /**
     * @var array
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
    ];
}
