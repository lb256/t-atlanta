
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\file\FileInput;
use dosamigos\multiselect\MultiSelect;
?>



<div class="journal-form">

    <?php
    Pjax::begin();
    ?>

    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'enableAjaxValidation' => true,
        'validationUrl' => \yii\helpers\Url::to(['validate-form'])]); ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'upload')->widget(FileInput::classname(), [
        'options' => ['accept' => '.jpg,.png', 'multiple' => false, 'id' => 'fi3'],
        'pluginOptions'=>[
            'maxFileSize'=> '5000',
            'showUpload' => false,
            'uploadAsync' => true,
            'showPreview' => true,
            'browseLabel' => 'Выбрать файл',
            'removeLabel' => 'Удалить',
            'dropZoneTitle' => 'Перетащите сюда файл картинки, .png или .jpg'
        ],

    ]) ?>



    <?= $form->field($model, 'authors[]')->widget(MultiSelect::className(),[
        'data' => $model->getAllAuthors(), "options" => ['multiple'=>"multiple", 'value'=>$model->getJournalAuthorsArr()],
        "clientOptions" =>
            [
                'numberDisplayed' => 8
            ],
    ]) ?>


    <?= $form->field($model, 'production_date')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>   </div>

    <?php ActiveForm::end(); ?>

</div>

    <?php
    Pjax::end();
    ?>



<?php
/*
$script = <<< JS
        $("#journal-upload").change(function() {
        $("#selected-image").attr("src", "$model->upload");
        alert($("#journal-upload").attr("name"));
        });
JS;
        $this->registerJs($script);
*/
?>