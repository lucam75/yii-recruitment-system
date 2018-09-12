<?php
$dataProvider = new CArrayDataProvider(Yii::app()->session['Educations'], array('keyField'=>'idEducation'));
$this->widget('zii.widgets.CListView', array(
    'id'=>'clvListEducations',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_detailEducation',
    'enableSorting'=>false,
    'enablePagination'=>false,
    'summaryText'=>'',
    'emptyText' => '',
));
?>