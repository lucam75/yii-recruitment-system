<h2><?php echo Yii::t('app','Admin email templates'); ?></h2>
<div class="row">
	<div class="col-xs-12">
		<?php echo Yii::t('app','these templates email that is sent to applicants when their resumes changes state.'); ?>
	</div>
</div>

<div id="divTemplate">
	<?php
	$this->widget('zii.widgets.CListView', array(
	    'id'=>'clvListSections',
	    'dataProvider'=>$dataprovider,
	    'itemView'=>'_detailTemplate',
	    'enableSorting'=>false,
	    'enablePagination'=>false,
	    'summaryText'=>'',
	    'emptyText' => '',
	));
	?>
</div>
 <div class="modal" id="template-modal">
  <div class="modal-dialog" style="width:800px;">
    <div class="modal-content">
    	<div class="idStatus"></div>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><?php echo Yii::t('app','Edit template'); ?></h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app','Cancel'); ?></button>
        <button type="button" class="btn btn-success" id="buttonOKModal"><?php echo Yii::t('app','Save'); ?></button>
      </div>
    </div>
  </div>
</div>