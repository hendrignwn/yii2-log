<?php

echo $this->render('/layouts/_menu');

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\log\models\LogModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Log Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
			['class' => 'yii\grid\SerialColumn'],

            'id',
            'model_name',
            [
				'attribute' => 'loggable',
				'value' => function($model) {
					return $model->getLoggableWithStyle();
				},
				'format' => 'raw',
			],
			
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
