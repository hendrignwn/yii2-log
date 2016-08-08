<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hendrignwn\log\models\LogModel */

$this->title = 'Update Log Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Log Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="log-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
