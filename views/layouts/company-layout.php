<?php use yii\widgets\Menu; ?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
	<div class="col-xs-2 no-padding">
		<div id="sidebar" class="btn-group btn-group-vertical menuV hidden-xs">
		
		<?php
			echo Menu::widget([
				'items' => [
					['label' => Yii::t('app','New'), 'url' => ['company/index']],
					['label' => Yii::t('app','Archived'), 'url' => ['company/archived']]
				],
				'linkTemplate' => '<a class="btn btn-default" href="{url}"><i class="fa fa-list-alt"></i> {label}</a>'
			]);
		?>
		</div><!-- sidebar -->
	</div>
	<div class="col-xs-10">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?= $this->registerJsFile(Yii::$app->request->BaseUrl . '/js/company.js', ['depends' => [yii\web\JqueryAsset::className()]]);
 ?>
<?php $this->endContent(); ?>