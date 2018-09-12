<div class="row">
    <div class="col-xs-12">
        <h2><?php echo Yii::t('app','Amount resumes by geographic region'); ?></h2>
        <?php
        $this->widget(
            'chartjs.widgets.ChBars',
            array(
                'width' => 900,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => $labels2,
                'datasets' => array(
                    array(
                        "fillColor" => "rgba(135, 255, 0, 0.8)",
                        "strokeColor" => "rgba(135, 255, 0, 0.8)",
                        "data" => $dataset2
                    )
                ),
                'options' => array()
            )
        );
    ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <h2><?php echo Yii::t('app','%Resumes by status'); ?></h2>
        <?php
            $this->widget(
                'chartjs.widgets.ChPie',
                array(
                    'htmlOptions' => array(),
                    'drawLabels' => true,
                    'datasets' => $dataset1,
                    'options' => array()
                )
            );
        ?>
    </div>
</div>