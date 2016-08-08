<?php

echo $this->render('/layouts/_menu');

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\log\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">
	
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?= Html::button('Search Log', ['id'=>'search-log-button', 'class'=>'btn btn-success'])?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'current_url:url',
            //'ip_address',
            'model',
            'model_id',
            // 'old_attributes:ntext',
            // 'new_attributes:ntext',
             'scenario',
             'created_at',
             'created_by',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}',
			],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php
$registerJs = "
	$('#search-log-button').click(function(){
		$('.log-search').toggle();
		return false;
	});
";
Yii::$app->view->registerJs($registerJs);