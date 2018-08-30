<?php

use yii\helpers\Html;

$fn = $model->fname.' '.$model->lname;
$this->title = 'Изменить данные автора: ' . $fn;
?>
<div class="author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
