<?php
    use yii\helpers\Html;
    use wbraganca\dynamicform\DynamicFormWidget;
?>
<?php DynamicFormWidget::begin([
					'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
					'widgetBody' => '.container-items', // required: css class selector
					'widgetItem' => '.item', // required: css class
					'limit' => 10, // the maximum times, an element can be added (default 999)
					'min' => 0, // 0 or 1 (default 1)
					'insertButton' => '.add-dynamic-item', // css class
					'deleteButton' => '.remove-dynamic-item', // css class
					'model' => $modelsSections[0],
					'formId' => 'resume-form',
					'formFields' => [
						'idSection',
						'typeSection_idtypeSection',
						'header',
						'description',
					],
				]); ?>

				<div class="row">
					<div class="col-xs-12">
						<h4>
							<button type="button" class="add-dynamic-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add</button>
						</h4>
					</div>
				</div>
				<div class="">
					<div class="container-items"><!-- widgetBody -->
						<?php foreach ($modelsSections as $i => $modelSections): ?>
							<div class="item"><!-- widgetItem -->
								<div class="row">
									<?php
										// necessary for update action.
										if (! $modelSections->isNewRecord) {
											echo Html::activeHiddenInput($modelSections, "[{$i}]idSection");
                                        }
                                        
                                        $modelSections->typeSection_idtypeSection = "2";
									?>
									<?php echo $form->field($modelSections, "[{$i}]typeSection_idtypeSection")->hiddenInput(['value'=>'3'])->label(false) ?>

									<div class="col-sm-4">
										<?= $form->field($modelSections, "[{$i}]header")->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-sm-7">
										<?= $form->field($modelSections, "[{$i}]description")->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-sm-1 pull-right">
										<button type="button" class="remove-dynamic-item btn btn-danger btn-xs" style="margin-top: 32px;"><i class="glyphicon glyphicon-minus"></i></button>
									</div>
								</div><!-- .row -->
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php DynamicFormWidget::end(); ?>