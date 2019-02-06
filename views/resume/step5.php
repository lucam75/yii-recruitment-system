<?php
    use yii\helpers\Html;
?>
<div id="divStep5" style="display:none" class="divStep">
	<div class="row">
		<div class="col-xs-12"><div class="text-center"><h2><?php echo Yii::t('app','Complementary documents'); ?></h2></div></div>
	</div>
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8 col-xs-12">
<?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
        'enableClientValidation'=>false,
        'action' => 'SaveFiles',
        'clientOptions'=>array(
            'validateOnSubmit'=>false,
            'validateOnChange'=>false,
            'validateOnType'=>false,
        ),
        'id' => 'document-form',
        'htmlOptions' => array(
            'class' => 'form',
            'enctype' => 'multipart/form-data',
        )
    ));
 ?>
 <?php
    $this->widget('CMultiFileUpload', array(
        'name' => 'document',
        'id'=>'document',
        'accept' => 'jpeg|jpg|gif|png|pdf|docx|doc', // useful for verifying files
        'duplicate' => Yii::t('app','Duplicate file!'), // useful, i think
        'denied' => Yii::t('app','Invalid file type'), // useful, i think
        // 'file'=>'Add new file',
         'options'=>array(
            // 'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
            // 'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
            'onFileAppend'=>'function(e, v, m){ $("#gridDocuments").show(); }',
            // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v); }',
            // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
            // 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v+" ._. "+e+" ._. "+m); }',
            'list'=>'#tableDocuments',
            'class'=>'btn btn-primary',
         ),
    ));
  ?>

            <br />
            <div class="row" id="gridDocuments" style="display:none;">
                <div class="col-xs-12">
                    <fieldset>
                        <legend><?php echo Yii::t('app','Attachments'); ?></legend>
                            <table class="table table-striped table-hover table-responsive text-center">
                              <thead>
                                <tr>
                                  <th class="text-center"><?php echo Yii::t('app','File'); ?></th>
                                  <th class="text-center"><?php echo Yii::t('app','Description'); ?></th>
                                  <th class="text-center"><?php echo Yii::t('app','Delete'); ?></th>
                                </tr>
                              </thead>
                              <tbody id="tableDocuments">

                              </tbody>
                            </table>

                    </fieldset>
                </div>
            </div>
        	<div class="row buttons-bar" style="margin-top:20px;">
        		<div class="col-xs-12">
        			<button class="pull-right btn btn-success" id="SendResume" type="button"><i class="fa fa-floppy-o"></i> <?php echo Yii::t('app','Send') ?></button>
        		</div>
        	</div>
		</div>
        <?php $this->endWidget(); ?>
		<div class="col-md-2"></div>
	</div>
</div>