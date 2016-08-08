<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hendrignwn\log\models\LogDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'log_id') ?>

    <?= $form->field($model, 'field') ?>

    <?= $form->field($model, 'old_value') ?>

    <?= $form->field($model, 'new_value') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
