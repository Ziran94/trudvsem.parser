<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContactsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contacts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idResume') ?>

    <?= $form->field($model, 'fio') ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'salary') ?>

    <?php // echo $form->field($model, 'positionName') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'idRegion') ?>

    <?php // echo $form->field($model, 'firstPublishedDate') ?>

    <?php // echo $form->field($model, 'publishedDate') ?>

    <?php // echo $form->field($model, 'genderType') ?>

    <?php // echo $form->field($model, 'demands') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
