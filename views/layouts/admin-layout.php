<?php use yii\widgets\Menu; ?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
	<div class="col-xs-2 no-padding">
		<div id="sidebar" class="btn-group btn-group-vertical menuV hidden-xs">
		
		<?php
			echo Menu::widget([
				'items' => [
					['label' => Yii::t('app','Changelog'), 'url' => ['administrator/changelog']],
					['label' => Yii::t('app','Statistics'), 'url' => ['administrator/statistics']],
					['label' => Yii::t('app','Email templates'), 'url' => ['administrator/templates']]
				],
				'linkTemplate' => '<a class="btn btn-default" href="{url}"><i class="fa fa-list-alt"></i> {label}</a>'
			]);
		?>
		</div><!-- sidebar -->
	</div>
	<div class="col-xs-10">
		<div id="content">
		<?= $content ?>
		</div><!-- content -->
	</div>
</div>
<?= $this->registerJsFile(Yii::$app->request->BaseUrl . '/js/admin.js', ['depends' => [yii\web\JqueryAsset::className()]]);
 ?>
<?= $this->endContent(); ?>