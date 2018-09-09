<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $dataprovider,
    'id' =>'gridStatus',
    'columns' =>array(
    	array('header'=>'ID','value'=>'$data["idChangeLogStatus"]','name'=>'id'),
		array(
			'header'=>Yii::t('app','State Old'),
			'type'=>'raw',
			'value'=>array($this,'stateOld'),
			'name'=>'stateOld',
		),
		array(
			'header'=>Yii::t('app','State New'),
			'type'=>'raw',
			'value'=>array($this,'stateNew'),
			'name'=>'stateNew',
		),
		array('header'=>Yii::t('app','Date & Time'),'value'=>'$data["date"]','name'=>'date'),
		array('header'=>Yii::t('app','Employee'),'value'=>'$data["employeesIdEmployee"]["name"]','name'=>'employee'),
		array('header'=>Yii::t('app','Rol'),'value'=>'$data["employeesRolesIdRol"]["name"]','name'=>'rol'),
	),
    'type' => BsHtml::GRID_TYPE_RESPONSIVE.' '.BsHtml::GRID_TYPE_HOVER.' '.BsHtml::GRID_TYPE_STRIPED

    ));
?>