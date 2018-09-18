<?php
	use yii\helpers\Url;
?>
<div class="row">
	<div class="col-xs-12">
		<div class="text-center">
			<h1><?php echo Yii::t('app','Resume'); ?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<h4><?php echo $this->context->spanState($model->statusResumesIdStatusResume->state); ?></h4>
	</div>
</div>
<div class="row hidden-xs">
	<div class="col-xs-10">
		<b><?php echo Yii::t('app','Professional profile: '); ?></b><br /> <p class="text-justify"> <?php echo $model->profile; ?> </p>
	</div>
	<div class="col-xs-2">
<img src="<?php echo Url::base()."/".$model->picture; ?>" class="img-responsive img-thumbnail" alt="Profile picture">
	</div>
</div>
<div class="row visible-xs">
	<div class="col-xs-12">
		<img src="<?php echo Url::base()."/".$model->picture; ?>" class="img-responsive img-thumbnail" alt="Profile picture">
	</div>
</div>
<div class="row visible-xs">
	<div class="col-xs-12">
		<b><?php echo Yii::t('app','Professional profile: '); ?></b><br /> <p class="text-justify"> <?php echo $model->profile; ?> </p>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<fieldset>
		    <legend><?php echo Yii::t('app','Personal information'); ?></legend>
		    <div class="row">
		    	<div class="col-xs-12">
		    		<div class="row" style="margin-bottom:10px;">
		        		<b><?php echo Yii::t('app','Name: '); ?></b> <?php echo $model->suffix." ".$model->firstName." ".$model->middleName." ".$model->lastName."."; ?>
				    </div>
		    		<div class="row" style="margin-bottom:10px;">
		        		<b><?php echo Yii::t('app','Gender: '); ?></b> <?php if($model->gender=='M'){ echo Yii::t('app','Male.');}else{ echo Yii::t('app','Female.'); } ?>
				    </div>
		    		<div class="row" style="margin-bottom:10px;">
		        		<b><?php echo Yii::t('app','Birthday: '); ?></b> <?php echo $model->birthday; ?>
				    </div>
		    		<div class="row" style="margin-bottom:10px;">
		        		<b><?php echo Yii::t('app','Marital status: '); ?></b> <?php echo Yii::t('app',$model->maritalStatusIdMaritalStatus->description); ?>
				    </div>
		    	</div>
		    </div>
		</fieldset>
	</div>
	<div class="col-md-6">
		<fieldset>
		    <legend><?php echo Yii::t('app','Contact information'); ?></legend>
		    <div class="row">
		    	<div class="col-xs-12">

					<div class="row" style="margin-bottom:10px;">
		        		<b><?php echo Yii::t('app','Phone: '); ?></b> <?php echo $model->phone; ?>
				    </div>
					<div class="row" style="margin-bottom:10px;">
		        		<b><?php echo Yii::t('app','Email: '); ?></b> <?php echo $model->email; ?>
				    </div>
		    		<div class="row" style="margin-bottom:10px;">
		        		<b><?php echo Yii::t('app','Hometown: '); ?></b> <?php echo $model->citiesIdCity->name." / ".$model->citiesIdCity->countriesIdCountry->name; ?>
				    </div>
		    		<div class="row" style="margin-bottom:10px;">
		        		<b><?php echo Yii::t('app','Address: '); ?></b> <?php echo $model->address; ?>
				    </div>
		    	</div>
		    </div>
		</fieldset>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Education & Formation'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->render('_listEducations',array('model'=>$model->educations)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Experience'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->render('_listSections',array('model'=>$model->experiences)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Achievements'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->render('_listSections',array('model'=>$model->achievements)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Hobbies'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->render('_listSections',array('model'=>$model->hobbies)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Personal interests'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->render('_listSections',array('model'=>$model->interests)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Personal references'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->render('_listSections',array('model'=>$model->references)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Complementary documents'); ?></h3>
		<?php echo $this->render('_listDocuments',array('model'=>$model->documents)); ?>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
<br />
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<?php
//echo CHtml::link("<i class='fa fa-reply' title='".Yii::t('app','Back')."'></i> ".Yii::t('app','Back'),array("Company/index"));
		 ?>
		<div class="pull-right">
			<button type="button" class="btn btn-danger" id="buttonReject" data-toggle="modal" data-target="#view-modal"><?php echo Yii::t('app','Reject'); ?></button>
			<button type="button" class="btn btn-warning" id="buttonPending" data-toggle="modal" data-target="#view-modal"><?php echo Yii::t('app','Pending'); ?></button>
			<button type="button" class="btn btn-success" id="buttonCall" data-toggle="modal" data-target="#view-modal"><?php echo Yii::t('app','Call for interview'); ?></button>
		</div>
	</div>
</div>

 <div class="modal fade" id="view-modal" role="dialog" aria-labelledby="myModalLabel" data-resume-id="<?= $model->idResume; ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
      	<div class="call" style="display:none;"><?php echo Yii::t('app','It will be sent an email informing the applicant about the decision. Confirm that you want to call for an interview?'); ?></div>
		<div class="reject" style="display:none;"><?php echo Yii::t('app','It will be sent an email informing the applicant about the decision. Confirm that you want to reject?'); ?></div>
		<div class="pending" style="display:none;"><?php echo Yii::t('app','It will be sent an email informing the applicant about the decision. Confirm that you want to change the status to pending for upcoming opportunities?'); ?></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app','Close'); ?></button>
        <button type="button" class="btn btn-success" id="buttonOKModal"><?php echo Yii::t('app','Send'); ?></button>
      </div>
    </div>
  </div>
</div>