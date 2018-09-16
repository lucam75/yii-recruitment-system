<?php /* @var $this Controller */ ?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
	<div class="col-xs-2">
		<div id="sidebar">
		
		<?php
			/*$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();*/
		?>
		</div><!-- sidebar -->
	</div>
	<div class="col-xs-10">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>