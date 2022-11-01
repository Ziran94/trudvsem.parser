<?php

namespace frontend\controllers;

use app\models\Regions;
use app\models\RegionsSearch;
use Yii;

use yii\data\ActiveDataProvider;
use yii\web\Controller;


/**
 * Site controller
 */
class SiteController extends Controller
{


    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionArchive()
    {
        return $this->render('index');
    }

    public function actionSettings()
    {
        $searchModel = new RegionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['status' => SORT_DESC]];


        return $this->render('settings', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}
