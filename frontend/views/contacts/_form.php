<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contacts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idResume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'salary')->textInput() ?>

    <?= $form->field($model, 'positionName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idRegion')->textInput() ?>

    <?= $form->field($model, 'firstPublishedDate')->textInput() ?>

    <?= $form->field($model, 'publishedDate')->textInput() ?>

    <?= $form->field($model, 'genderType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'demands')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
