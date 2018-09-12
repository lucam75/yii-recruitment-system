<?php
$dataProvider = new CArrayDataProvider(Yii::app()->session[$session], array('keyField'=>'idSection'));
$this->widget('zii.widgets.CListView', array(
    'id'=>'clvListSections',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_detailSection',
    'enableSorting'=>false,
    'enablePagination'=>false,
    'summaryText'=>'',
    'emptyText' => '',
));
?>