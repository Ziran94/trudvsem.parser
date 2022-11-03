<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;

$this->title = 'Настройки';
?>
<div class="settings-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="conteiner-fluid d-flex">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'status',
                'value' => function($data){
                    if ($data->status == 0)
                        return Html::a('Включить', ['settings/toggle-region', "id" => $data->id], ['class' => 'btn btn-success']);
                    if ($data->status == 1)
                        return Html::a('Исключить', ['settings/toggle-region', "id" => $data->id], ['class' => 'btn btn-danger']);;
                },
                'format' => ["raw"]
            ],
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Regions $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                }
//            ],
        ],
        'pager' => [
            'maxButtonCount' => 5, // максимум 5 кнопок
            'options' => ['id' => 'mypager', 'class' => 'pagination'], // прикручиваем свой id чтобы создать собственный дизайн не касаясь основного.
//            'nextPageLabel' => '<i class="ionicons ion-arrow-right-c">123</i>', // стрелочка в право
//            'prevPageLabel' => '<i class="ionicons ion-arrow-left-c">123</i>', // стрелочка влево
        ],
    ]); ?>


        <?php
        $form = ActiveForm::begin();

        foreach ($settings as $index => $setting) {
//            if($index == 0)
            echo $form->field($setting, "[$index]value")->label($setting->name);
//            else
//                echo $form->field($setting, "[$index]value")->widget(DatePicker::class, [
//                    'language' => 'ru',
//                    //'dateFormat' => 'dd.MM.yyyy,
//                    'options' => [
////                        'placeholder' => Yii::$app->formatter->asDate($model->created_at),
//                        'class'=> 'form-control',
//                        'autocomplete'=>'off'
//                    ],
//                    'clientOptions' => [
//                        'changeMonth' => true,
//                        'changeYear' => true,
//                        'yearRange' => '2015:2050',
//                        //'showOn' => 'button',
//                        //'buttonText' => 'Выбрать дату',
//                        //'buttonImageOnly' => true,
//                        //'buttonImage' => 'images/calendar.gif'
//                    ]])->label(false);
        }
        ?>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
    </div>
</div>
