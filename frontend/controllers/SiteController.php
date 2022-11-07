<?php

namespace frontend\controllers;

use app\models\ContactsSearch;
use app\models\Regions;
use app\models\RegionsSearch;
use app\models\Settings;
use Yii;

use yii\base\Model;
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
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['AND',["status"=>"0"],['OR',["!=", "email", "NULL"],["!=", "phone", "NULL"]]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArchive()
    {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(["status"=>"1"]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSettings()
    {
        $searchModel = new RegionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['status' => SORT_DESC]];


        $settings = Settings::find()->all();

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }
        }

        return $this->render('settings', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'settings'      => $settings,
        ]);
    }


}
