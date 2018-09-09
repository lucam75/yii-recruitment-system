<h2><?php echo Yii::t('app','Incoming resumes'); ?></h2>


<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $dataprovider,
    'id' =>'gridResumes',
    'columns' =>array(
		array(
        	'header'=>'<a style="text-decoration:none;">#</a>',
        	'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		),
		array(
			'header'=>Yii::t('app','State'),
			'type'=>'raw',
			'value'=>array($this,'state'),
			'name'=>'state',
		),
		array('header'=>Yii::t('app','Date application'), 'name'=>'dateApplication'),
		array('header'=>Yii::t('app','Applicant'),'value'=>'$data["suffix"]." ".$data["firstName"]." ".$data["middleName"]." ".$data["lastName"]','name'=>'applicant'),
		array(
        	'header'=>'<a style="text-decoration:none;">'.Yii::t('app','Options').'</a>',
            'type'=>'raw',
            'value'=>array($this,'optionsColumn')
        ),
	),
    'type' => BsHtml::GRID_TYPE_RESPONSIVE.' '.BsHtml::GRID_TYPE_HOVER.' '.BsHtml::GRID_TYPE_STRIPED

    ));
?>