<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model hendrignwn\log\models\LogDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Log Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'log_id',
            'field',
            'old_value:ntext',
            'new_value:ntext',
        ],
    ]) ?>

</div>
