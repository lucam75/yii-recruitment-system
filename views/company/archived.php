<?php 
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use app\models\Statusresumes;
    use kartik\daterange\DateRangePicker;
?>
<h2><?php echo Yii::t('app','Archived resumes'); ?></h2>

<?php $form = ActiveForm::begin([
        'id' => 'archived-search-form',
    ]); ?>
<div class="row"><div class="col-xs-12"></div></div>
<fieldset>
    <legend><?php echo Yii::t('app','Search'); ?></legend>
<div class="row">
    <div class="col-xs-6">
        <dl style="margin:0px;">
          <dt><?php echo Yii::t('app','Applicant'); ?></dt>
          <dd><input class="form-control" type="text" id="keyword" name="keyword" placeholder="<?php echo Yii::t('app','keyword'); ?>" style="height:auto"></dd>
        </dl>

    </div>
    <div class="col-xs-6">
        <dl style="margin:0px;">
          <dt><?php echo Yii::t('app','Date range'); ?></dt>
            <dd style="cursor:pointer !important;">
				<div class="form-group" id="reportrange" >
				  <div class="input-group">
                    <?php 
                    echo DateRangePicker::widget([
                        'name'=>'daterange',
                        'presetDropdown'=>true,
                        'hideInput'=>true,
                        'pluginOptions'=>[
                            'locale'=>[
                                'format'=>'D/M/YYYY',
                                'separator'=>' to ',
                            ],
                        ]
                    ]);
                    ?>
				  </div>
				</div>
            </dd>
        </dl>

    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <dl style="margin:0px;">
          <dt><?php echo Yii::t('app','States'); ?></dt>
          <dd>
            <?php
        echo '<div class="row">';
		foreach (Statusresumes::find()->all() as $key) {
			if($key->idStatusResume!='1')
				echo '<div class="col-xs-4 col-md-3"><label><input type="checkbox" name="States[]" value="  '.$key->idStatusResume.'">'.$this->context->spanState($key->state)." </label></div>";
		}
        echo '</div>';
        ?>
          </dd>
        </dl>

    </div>
    <div class="col-xs-6">
        <?= Html::submitButton(Yii::t('app','Search'), ['class' => 'btn btn-default pull-right', 'name'=>'submit-archived']) ?>
    </div>
</div>

<?php //$this->endWidget(); ?>

<?php ActiveForm::end(); ?>
</fieldset>
<div id="searchDiv" style="margin-top:20px;">
    <?php echo $this->render("_gridResumes",array('dataProvider'=>$dataProvider)) ?>
</div>