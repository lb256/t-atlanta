<?php

use yii\helpers\Html;

$this->title = 'Добавить автора';

?>
<div class="author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
