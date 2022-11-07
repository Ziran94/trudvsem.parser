<?php

namespace frontend\controllers;

use app\models\Contacts;
use app\models\Regions;
use app\models\RegionsSearch;
use app\models\Settings;
use app\models\TrudVsem;
use Yii;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use function PHPUnit\Framework\any;


/**
 * Site controller
 */
class ParserController extends Controller
{


    public function actionGetResume()
    {
        $settings = Settings::all();
        $regions = Regions::getCodes();
        $trudvsem = new TrudVsem($settings, $regions);


        foreach ($trudvsem->getResume() as $resume) {

            if (in_array($resume[0], Contacts::getIds())){
                continue;
            }
            $id = $resume[0];//кандидат
            $id2 = $resume[1];//резюме

            $candidate = $trudvsem->getCandidate($id, $id2);//$candidate->data->cv->fio, $candidate->data->cv->salary, $candidate->data->candidate->age, $candidate->data->cv->workExperiences[0]->demands

            $contact = new Contacts();
            $contact->addCandidate($candidate);

        }


        return $this->redirect('/settings');
    }

    public function actionStart()
    {
        return $this->redirect('/settings');
    }


}
