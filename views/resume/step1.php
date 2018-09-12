<div id="divStep1">
    <div class="row noSummary">
        <div class="col-xs-12">
            <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 0%"></div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12"><div class="text-center"><h2><?php echo Yii::t('app','Personal and contact information'); ?></h2></div></div>
    </div>
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8 col-xs-12">
    		<?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
        // 'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
            'validateOnType'=>true,
        ),
        'id' => 'resume-form',
        'htmlOptions' => array(
            'class' => 'form',
            'enctype' => 'multipart/form-data',
        )
    ));
    ?>
    <label class="control-label"><?php echo Yii::t('app','Professional profile') ?></label>
    <?php echo $form->textArea($model, 'profile');?>
    <fieldset>
    <legend><?php echo Yii::t('app','Personal information'); ?></legend>
    <?php
    // echo $form->textFieldControlGroup($model, 'username', array(
        // 'prepend' => BsHtml::icon(BsHtml::GLYPHICON_USER)
    // ));
    ?>
    <?php echo $form->textFieldControlGroup($model, 'firstName', array('placeholder' => Yii::t('app','First name'))); ?>
    <?php echo $form->textFieldControlGroup($model, 'middleName', array('placeholder' => Yii::t('app','Middle name'))); ?>
    <?php echo $form->textFieldControlGroup($model, 'lastName', array('placeholder' => Yii::t('app','Last name'))); ?>
    <?php
    echo $form->radioButtonListControlGroup($model, 'gender',array('M'=>'Male','F'=>'Female'));
    ?>
    <?php echo $form->textFieldControlGroup($model, 'suffix', array('placeholder' => Yii::t('app','Suffix'))); ?>
    <?php echo $form->dateFieldControlGroup($model, 'birthday', array('placeholder' => Yii::t('app','Birthday'))); ?>

     <?php echo $form->fileFieldControlGroup($model, 'picture', array('placeholder' => Yii::t('app','Picture'),'accept' => 'image/*')); ?>
    <?php echo $form->numberFieldControlGroup($model, 'expectedSalary', array('placeholder' => Yii::t('app','Expected salary, local currency'))); ?>
    <?php
    $states = CHtml::listData(Maritalstatus::model()->findAll(array('order'=>'idMaritalStatus ASC')),'idMaritalStatus', 'description');
    echo $form->radioButtonListControlGroup($model, 'maritalStatus_idMaritalStatus',$states);
    ?>
    <?php
    // echo BsHtml::formActions(array(
    //     BsHtml::submitButton('Submit', array(
    //         'color' => BsHtml::BUTTON_COLOR_PRIMARY
    //     ))
    // ));
    ?>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('app','Contact information'); ?></legend>
        <?php echo $form->emailFieldControlGroup($model, 'email', array('placeholder' => Yii::t('app','Email'))); ?>
        <?php echo $form->telFieldControlGroup($model, 'phone', array('placeholder' => Yii::t('app','Phone number'))); ?>
        <?php echo $form->textAreaControlGroup($model, 'address'); ?>
        <?php
        $htmlOption = array(
            // 'style'=>'width:auto;',
            'empty' => Yii::t('app','Select your country ...'),
            'class' => 'form-control',
            'ajax'=>array(
                "url"=>Yii::app()->createUrl("resume/CitiesByCountries"),
                "type"=>"POST",
                "update"=>"#Resumes_cities_idCity",
            ),
        );
        $listDataCountry = CHtml::listData(Countries::model()->findAll(array('order'=>'name ASC')),'idCountry', 'name'); ?>
        <div class="form-group">
            <label class="control-label col-lg-3 required" for="Resumes_cities_idCities">Country </label>
            <div class="col-lg-9">
                <?php echo CHtml::dropDownList('idCountry', 'id',$listDataCountry,$htmlOption); ?>
            </div>
        </div>
        <?php $listDataCity = CHtml::listData(Cities::model()->findAll(array('order'=>'name ASC')),'idCity', 'name'); ?>
        <?php echo $form->dropDownListControlGroup($model, 'cities_idCity',$listDataCity); ?>

<div class="summary">
    <?php if(CCaptcha::checkRequirements()): ?>
        <div class="col-lg-3"></div>
        <div class="col-lg-9">
            <?php $this->widget('CCaptcha'); ?>
        </div>
    <?php echo $form->textFieldControlGroup($model, 'verifyCode', array('placeholder' => Yii::t('app','captcha'))); ?>
    <?php endif; ?>
</div>
    <?php $this->endWidget(); ?>
    </fieldset>

            <div class="row noSummary" style="margin-top:20px;">
                <div class="col-xs-12">
                <?php
                echo BsHtml::button(Yii::t('app','Next step').' <i class="fa fa-arrow-right"></i>', array(
                    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
                    'class'=>'pull-right NAVIGABLE',
                    'to'=>'toStep2',
                ));
                ?>
                </div>
            </div>
    	</div>
    	<div class="col-md-2"></div>
    </div>
</div>