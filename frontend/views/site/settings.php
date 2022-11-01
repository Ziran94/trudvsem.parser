<?php
use app\models\Regions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'Настройки';
?>
<div class="settings-index">
    <h1><?= Html::encode($this->title) ?></h1>


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
</div>
