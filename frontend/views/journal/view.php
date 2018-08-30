<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->name;
?>
<div class="journal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно удалять?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'desc',
            [
                'label'  => 'Картинка',
                'format' => 'raw',
                'value'  => function($model){
                    return '<a href="'.$model->img_file.'" target="_blank"><img style="max-width:300px" src="'.$model->img_file.'"></a>';
                },

            ],

            [
                'label'  => 'Авторы',
                'format' => 'raw',
                'value'  => function($model){
                    return implode(', ', $model->getJournalAuthorsNames());
                },

            ],


            'production_date',
        ],
    ]) ?>
    <?= Html::a('OK', ['index'], ['class' => 'btn btn-primary']) ?>

</div>