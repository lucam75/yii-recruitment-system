<?php
$dataProvider = new CArrayDataProvider($model, array('keyField'=>'idSection'));
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