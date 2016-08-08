<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hendrignwn\log\models\Log;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Log */

$this->title = $model->model . ' ['.$model->model_id.']';
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'current_url:url',
            'ip_address',
            'model',
            'model_id',
            'old_attributes:ntext',
            'new_attributes:ntext',
            'scenario',
            'created_at',
            'created_by',
        ],
    ]) ?>
	
	<?php
		if(count($model->logDetails) > 0) {
			
			Pjax::begin(); 
			
			echo GridView::widget([
				'dataProvider' => $logDetails,
				'filterModel' => $searchLogDetail,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					'field',
					'old_value:ntext',
					'new_value:ntext',

					[
						'class' => 'yii\grid\ActionColumn',
						'template'=>'{view}',
					],
				],
			]);
			
			Pjax::end();
		}
	
	?>
</div>
