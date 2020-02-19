<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?= $this->render('menu') ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php
$css =<<<CSS
    .pjax-loader {
        background-color: rgba(255,255,255,0.7);
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh; /* to make it responsive */
        width: 100vw; /* to make it responsive */
        overflow: hidden; /*to remove scrollbars */
        z-index: 1000000 !important; /*to make it appear on topmost part of the page */
    }
    .pjax-loader img {
        position: relative;
        top:50%;
        left:50%;
    }

CSS;
$this->registerCss($css);
$js =<<<JS
    $(document).on('pjax:start',  function(event){
        $('.pjax-loader').show();
    });
    $(document).on('pjax:complete',  function(event){
        $('.pjax-loader').hide();
    });
JS;
$this->registerJS($js);
?>
<div class="pjax-loader" style="display:none">
    <img src="/img/loading.gif" class="img-responsive" />
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
