<h2><?php echo Yii::t('app','ChangeLog'); ?></h2>

<?php echo CHtml::beginForm(); ?>
<div class="row"><div class="col-xs-12"></div></div>
<fieldset>
    <legend><?php echo Yii::t('app','Search'); ?></legend>
<div class="row">
    <div class="col-xs-6">
        <dl style="margin:0px;">
          <dt><?php echo Yii::t('app','Employee'); ?></dt>
          <dd><input class="form-control" type="text" id="keyword" name="keyword" placeholder="<?php echo Yii::t('app','keyword'); ?>" style="height:auto"></dd>
        </dl>

    </div>
    <div class="col-xs-6">
        <dl style="margin:0px;">
          <dt><?php echo Yii::t('app','Date range'); ?></dt>
            <dd style="cursor:pointer !important;">
                <div class="form-group" id="reportrange" >
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" id="range" placeholder="<?php echo Yii::t('app','Date range'); ?>" style="cursor:pointer !important;" name="daterange">
                  </div>
                </div>
            </dd>
        </dl>

    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <dl style="margin:0px;">
          <dt><?php echo Yii::t('app','State Old'); ?></dt>
          <dd>
            <?php
        $state = Statusresumes::model();
        foreach ($state->findAll(array('order'=>'idStatusResume')) as $key) {
                echo '<label><input type="radio" name="StateOld" value="'.$key->idStatusResume.'">'.Yii::t('app',$this->spanState($key->state))."</label>";
        }
        ?>
          </dd>
        </dl>

    </div>
    <div class="col-xs-4">
        <dl style="margin:0px;">
          <dt><?php echo Yii::t('app','State New'); ?></dt>
          <dd>
            <?php
        $state = Statusresumes::model();
        foreach ($state->findAll(array('order'=>'idStatusResume')) as $key) {
                echo '<label><input type="radio" name="StateNew" value="'.$key->idStatusResume.'">'.Yii::t('app',$this->spanState($key->state))."</label>";
        }
        ?>
          </dd>
        </dl>

    </div>
    <div class="col-xs-4">
        <!-- <input id="filtrar" type="submit" class="crear_boton" value="Filtrar"> -->
        <?php
        echo "<br />";
            echo CHtml::ajaxSubmitButton(
                Yii::t('app','Search'),
                array('Administrator/SearchChangelog'),
                array('update'=>'#searchDiv'),
                array('class'=>'btn btn-default pull-right')
            );
        ?>
    </div>
</div>

<?php //$this->endWidget(); ?>

<?php echo CHtml::endForm(); ?>
</fieldset>
<div id="searchDiv" style="margin-top:20px;">
    <?php echo $this->renderPartial("_gridChangelog",array('dataprovider'=>$dataprovider)); ?>
</div>