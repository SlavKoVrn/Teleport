<?php

namespace app\controllers\user;

use dektrium\user\models\LoginForm;
use dektrium\user\controllers\SecurityController as BaseSecurityController;

use Yii;

class SecurityController extends BaseSecurityController
{

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
            return $this->goBack();
        }

        if (Yii::$app->request->isAjax){
            return $this->renderAjax('login', [
                'model'  => $model,
                'module' => $this->module,
            ]);
        } else {
            return $this->render('login', [
                'model'  => $model,
                'module' => $this->module,
            ]);
        }
    }

}
