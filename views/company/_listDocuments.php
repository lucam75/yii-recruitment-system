<?php
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use app\models\Resumes;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model,
    'pagination'=>[
        'pageSize'=>10
    ],
]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => '',
	'tableOptions' => [
        'class' => 'table table-responsive',
        'id' => 'sortable-table',
    ],
    'id' =>'gridResumes',
    'columns' =>[
		[
			'class' => 'yii\grid\SerialColumn',
        ],
        ['header'=>Yii::t('app','Document'),'attribute'=>'document'],
		['header'=>Yii::t('app','Description'),'attribute'=>'description'],
		['header'=>Yii::t('app','Type'),'attribute'=>'type'],
		[
        	'header'=>Yii::t('app','View'),
            'format'=>'raw',
            'value'=>array($this->context,'optiondoc')
        ],
	]
]);

?>