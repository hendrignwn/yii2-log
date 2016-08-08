<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hendrignwn\log\models\LogModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'model_name')->label($model->getAttributeLabel('model_name').' '.$model->getMessage())->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loggable')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
