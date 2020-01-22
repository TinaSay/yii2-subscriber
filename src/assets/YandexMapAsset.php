<?php

namespace tina\subscriber\assets;

use krok\extend\widgets\YMap\YMapWidgetAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

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
    public $sourcePath = '@tina/subscriber/assets/dist';

    /**
     * @var array
     */
    public $js = [
        'js/yandexMap.js',
    ];

    /**
     * @var array
     */
    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV,
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
        YMapWidgetAsset::class,
    ];
}
