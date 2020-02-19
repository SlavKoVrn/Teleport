<?php

/* @var $this \yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

use yii\authclient\widgets\AuthChoiceAsset;
AuthChoiceAsset::register($this);

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
        Yii::$app->user->isGuest ? (
        [
            'label' => 'Login',
            'url' => ['/user/login'],
            'options'=>[
                'href'=>'#modal',
                'data-toggle'=>'modal',
                'onclick'=>'return false',
            ]
        ]
        ) : (
            '<li>'
            . Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ],
]);
NavBar::end();

$js =<<<JS
     $('#modal').on('show.bs.modal', function(e) {
        var target = e.relatedTarget;
         $.ajax({
            type: 'post',
            url: $(target).find('a').attr('href'),
            success: function (data) {
                $('#modal').find('.modal-body').html(data);
                $('ul.auth-clients').authchoice();
            }
         });
     });
JS;
$this->registerJS($js);
$css =<<<CSS
    .modal-content .modal-header .close {
        position: absolute;
        width: 32px;
        height: 32px;
        right: -14px;
        top: -14px;
        opacity: 1;
        border-radius: 50%;
        background-color: #fff;
        -webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.4);
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.4);
        outline: none;
        margin: 0;
        padding: 0; }
    .modal-content .modal-header .close span {
        color: #a8a8a8;
        font-weight: normal;
        text-shadow: none;
        margin-right: -2px; }
    .modal-content .modal-header .close:hover {
        opacity: 1; }
    @media screen and (max-width: 576px) {
        .modal-content .modal-header .close {
            -webkit-box-shadow: none;
            box-shadow: none;
            right: 5px;
            top: 5px; }
        .modal-content .modal-header .close span {
            font-size: 35px; }
    }
CSS;
$this->registerCss($css);
?>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="modal-body" class="modal-body"></div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
