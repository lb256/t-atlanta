<?php
use yii\helpers\Html;

$this->title = 'Добавить Журнал';
?>

<div class="journal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
