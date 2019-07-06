<?php

namespace terabytesoft\assets\floatlabel\tests;

use terabytesoft\assets\floatlabel\FloatingLabelAsset;
use terabytesoft\assets\floatlabel\tests\UnitTester;
use yii\bootstrap4\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\web\YiiAsset;

/**
 * Class FloatingLabelAsset
 *
 * Unit tests for codeception asset font awesome free all css webfont developer
 */
class FloatingLabelAssetCest
{
    /**
     * @var \yii\web\View;
     */
    private $view;

    /**
     *  _before
     *
     * @param UnitTester $I
     */
    public function _before(UnitTester $I): void
    {
        $this->view = new View();
    }

    /**
     * _after
     *
     * @param UnitTester $I
     */
    public function _after(UnitTester $I): void
    {
        unset($this->view);
    }

    /**
     * testFloatingLabelAssetRegister
     *
     * @param UnitTester $I
     */
    public function testFloatingLabelAssetRegister(UnitTester $I): void
    {
        $I->assertEmpty($this->view->assetBundles);

        FloatingLabelAsset::register($this->view);

        $I->assertCount(4, $this->view->assetBundles);

        $I->assertArrayHasKey(FloatingLabelAsset::class, $this->view->assetBundles);
        $I->assertArrayHasKey(BootstrapAsset::class, $this->view->assetBundles);
        $I->assertArrayHasKey(YiiAsset::class, $this->view->assetBundles);
        $I->assertArrayHasKey(JqueryAsset::class, $this->view->assetBundles);


        $result = $this->view->renderFile(codecept_data_dir() . 'main.php');

        $I->assertRegexp('/bootstrap.css/', $result);
        $I->assertRegexp('/floatinglabels.css/', $result);
        $I->assertRegexp('/jquery.js/', $result);
        $I->assertRegexp('/yii.js/', $result);
    }

    /**
     * testFloatingLabelAssetSimpleDependency
     *
     * @param UnitTester $I
     */
    public function testFloatingLabelAssetSimpleDependency(UnitTester $I): void
    {
        $I->assertEmpty($this->view->assetBundles);

        FloatingLabelAsset::register($this->view);

        $I->assertCount(4, $this->view->assetBundles);

        $I->assertArrayHasKey(FloatingLabelAsset::class, $this->view->assetBundles);
        $I->assertArrayHasKey(BootstrapAsset::class, $this->view->assetBundles);
        $I->assertArrayHasKey(YiiAsset::class, $this->view->assetBundles);
        $I->assertArrayHasKey(JqueryAsset::class, $this->view->assetBundles);

        $I->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[FloatingLabelAsset::class]);
        $I->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[BootstrapAsset::class]);
        $I->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[YiiAsset::class]);
        $I->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[JqueryAsset::class]);
    }

    /**
     * testFloatingLabelAssetSourcesPublish
     *
     * @param UnitTester $I
     */
    public function testFloatingLabelAssetSourcesPublish(UnitTester $I): void
    {
        $bundle = FloatingLabelAsset::register($this->view);

        $I->assertTrue(is_dir($bundle->basePath));

        $I->sourcesPublishVerifyFiles('css', $bundle);

        $I->sourcesPublishVerifyFilesOnly($bundle);
    }
}
