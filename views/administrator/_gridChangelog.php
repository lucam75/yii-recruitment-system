<?php
// $this->widget('bootstrap.widgets.BsGridView', array(
//     'dataProvider' => $dataprovider,
//     'id' =>'gridStatus',
//     'columns' =>array(
//     	array('header'=>'ID','value'=>'$data["idChangeLogStatus"]','name'=>'id'),
// 		array(
// 			'header'=>Yii::t('app','State Old'),
// 			'type'=>'raw',
// 			'value'=>array($this,'stateOld'),
// 			'name'=>'stateOld',
// 		),
// 		array(
// 			'header'=>Yii::t('app','State New'),
// 			'type'=>'raw',
// 			'value'=>array($this,'stateNew'),
// 			'name'=>'stateNew',
// 		),
// 		array('header'=>Yii::t('app','Date & Time'),'value'=>'$data["date"]','name'=>'date'),
// 		array('header'=>Yii::t('app','Employee'),'value'=>'$data["employeesIdEmployee"]["name"]','name'=>'employee'),
// 		array('header'=>Yii::t('app','Rol'),'value'=>'$data["employeesRolesIdRol"]["name"]','name'=>'rol'),
// 	),
//     'type' => BsHtml::GRID_TYPE_RESPONSIVE.' '.BsHtml::GRID_TYPE_HOVER.' '.BsHtml::GRID_TYPE_STRIPED

//     ));
 ?>
<?php
	use yii\grid\GridView;
	use yii\widgets\Pjax;
?>
<?php
Pjax::begin([
    // PJax options
]);
echo GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'tableOptions' => [
        'class' => 'table table-responsive',
        'id' => 'sortable-table',
    ],
    'id' =>'gridStatus',
    'columns' =>[
		[
			'class' => 'yii\grid\SerialColumn',
		],
		[
			'header'=>Yii::t('app','Status Old'),
			'value'=>function($data) { return $this->context->spanState($data->statusOldText->state); },
			'attribute' => 'statusOld',
			'format' => 'raw',
		],
		[
			'header'=>Yii::t('app','Status New'),
			'value'=>function($data) { return $this->context->spanState($data->statusNewText->state); },
			'attribute' => 'statusNew',
			'format' => 'raw',
		],
		[
            'attribute' => 'date',
            'format' => ['date', 'php:d/m/Y h:m']
        ],
		[
			'header'=>Yii::t('app','Employee'),
			'value'=>function($data) { return $data->employeesIdEmployee->name; },
			// 'attribute' => 'firstName',
		],
	]
]);
Pjax::end();
?>