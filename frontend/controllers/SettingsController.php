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
class SettingsController extends Controller
{


    public function actionToggleRegion($id = null)
    {
        $model = Regions::findOne($id);
        $model->toggleStatus();

        return $this->redirect('/settings');
    }


}
