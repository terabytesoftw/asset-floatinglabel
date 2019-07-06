<?php

/**
 * FloatingLabelAsset
 **/

namespace terabytesoft\assets\floatlabel;

use yii\web\AssetBundle;

class FloatingLabelAsset extends AssetBundle
{
    /**
     * @var array $css
     */
    public $css = [
        'floatinglabels.css',
    ];

    /**
     * @var array $depends
     */
    public $depends = [
        \yii\web\YiiAsset::class,
        \yii\bootstrap4\BootstrapAsset::class,
    ];

    /**
     * @var array $publishOptions
     */
    public $publishOptions = [
        'only' => [
            'floatinglabels.css',
        ],
    ];

    /**
     * @var string $sourcePath
     */
    public $sourcePath = __DIR__ . '/css';

    /**
     * init
     */
    public function init(): void
    {
        parent::init();
    }
}
