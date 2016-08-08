<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hendrignwn\log\models\LogDetail */

$this->title = 'Create Log Detail';
$this->params['breadcrumbs'][] = ['label' => 'Log Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
