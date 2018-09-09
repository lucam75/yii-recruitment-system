<div style="color:#777; margin-top:10%;">
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1>Error <?php echo $code; ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center">
			<i class="fa fa-frown-o fa-4x"></i>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center">
			<div class="error">
				<?php echo CHtml::encode($message); ?>
			</div>
		</div>
	</div>
</div>