<div class="row">
	<div class="col-xs-8">
		<div class="text-left">
			<h1><?php echo Yii::t('app','Resume'); ?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-5">
		<h4><?php echo $this->state($model); ?></h4>
	</div>
	<div class="col-xs-2 pull-right">
		<img src="<?php echo Yii::app()->baseUrl."/".$model->picture; ?>" class="img-responsive img-thumbnail" alt="Responsive image">
	</div>
</div>
<div class="row">
	<div class="col-md-5">
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
	<div class="col-md-5">
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
		<b><?php echo Yii::t('app','Professional profile: '); ?></b><br /> <p class="text-justify"> <?php echo $model->profile; ?> </p>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Education & Formation'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->renderPartial('_listEducations',array('model'=>$model->educations)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Experience'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->renderPartial('_listSections',array('model'=>$model->experiences)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Achievements'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->renderPartial('_listSections',array('model'=>$model->achievements)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Hobbies'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->renderPartial('_listSections',array('model'=>$model->hobbies)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Personal interests'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->renderPartial('_listSections',array('model'=>$model->interests)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Personal references'); ?></h3>
		<div class="row" style ="margin-top:10px;">
			<ul>
				<?php echo $this->renderPartial('_listSections',array('model'=>$model->references)); ?>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3><?php echo Yii::t('app','Complementary documents'); ?></h3>
<?php
$documents =$dataProvider = new CArrayDataProvider($model->documents, array('keyField'=>'idDocument'));
$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' =>$documents,
    'id' =>'gridDocuments',
    'columns' =>array(
		array('header'=>Yii::t('app','Document'),'name'=>'document'),
		array('header'=>Yii::t('app','Description'),'name'=>'description'),
		array('header'=>Yii::t('app','Type'),'name'=>'type'),
	),
    'type' => BsHtml::GRID_TYPE_STRIPED." ".BsHtml::GRID_TYPE_CONDENSED

    ));
?>
	</div>
</div>
