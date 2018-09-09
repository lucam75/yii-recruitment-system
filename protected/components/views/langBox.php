<?php echo CHtml::form(); ?>
    <div id="langdrop ">
        <?php echo CHtml::dropDownList('_lang', $currentLang, array(
            'en' => 'English', 'es' =>'Español'), array('submit' => '')); ?>
    	<div class="pull-right" style="margin-right:5px;"><?php echo Yii::t('app','Language:');  ?></div>
    </div>
<?php echo CHtml::endForm(); ?>
<script>
// $("#_lang").parent().parent().attr("style","margin-bottom:0px; background-color:white;");
$("#_lang").attr("class","pull-right");
jQuery('body').on('click','#es',function(){jQuery.yii.submitForm(this,'',{_lang:'es'});return false;});
jQuery('body').on('click','#en',function(){jQuery.yii.submitForm(this,'',{_lang:'en'});return false;});
</script>