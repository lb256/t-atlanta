<?php

use yii\helpers\Html;

$this->title = 'Обновить журнал: ' . $model->name;

?>
<div class="journal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
