<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>


<div class="author-form">
    <?php
    Pjax::begin();
    ?>
    <?php $form = ActiveForm::begin([
   //     'id' => 'registration-form',
    //    'enableAjaxValidation' => true,
     //   'validationUrl' => \yii\helpers\Url::to(['validate-form'])
    ]); ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    Pjax::end();
    ?>
</div>
