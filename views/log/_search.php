<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\log\models\LogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-search" style="display:none;">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'current_url') ?>

    <?= $form->field($model, 'ip_address') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'model_id') ?>

    <?php  echo $form->field($model, 'old_attributes') ?>

    <?php  echo $form->field($model, 'new_attributes') ?>

    <?php  echo $form->field($model, 'scenario') ?>

    <?php  echo $form->field($model, 'created_at') ?>

    <?php  echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
