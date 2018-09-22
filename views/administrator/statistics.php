<?php
    use dosamigos\chartjs\ChartJs;
?>
<div class="row">
    <div class="col-xs-6">
        <h2><?php echo Yii::t('app','Resumes by status'); ?></h2>
        <?php
        if(!empty($dataset)){
            echo ChartJs::widget([
                'type' => 'doughnut',
                'id' => 'structurePie',
                'options' => [
                    'height' => 10,
                    'width' => 20,
                ],
                'data' => [
                    'radius' =>  "100%",
                    'labels' => array_column($dataset, 'label'), // Your labels
                    'datasets' => [
                        [
                            'data' => array_column($dataset, 'value'), // Your dataset
                            'backgroundColor' => array_column($dataset, 'color'),
                            'borderColor' =>  [
                                    '#fff',
                                    '#fff',
                                    '#fff',
                                    '#fff'
                            ],
                            'borderWidth' => 5,
                            'hoverBorderColor'=>["#999","#999","#999","#999"],                
                        ]
                    ]
                ],
                'clientOptions' => [
                    'legend' => [
                        'display' => true,
                        'position' => 'right',
                        'labels' => [
                            'fontSize' => 16,
                            'fontColor' => "#425062",
                        ]
                    ],
                    'tooltips' => [
                        'enabled' => true,
                        'intersect' => false
                    ],
                    'hover' => [
                        'mode' => true
                    ],
                    'maintainAspectRatio' => true,
            
                ],
                
            ]);
        }else{
            echo "No data";
        }
        ?>
    </div>
</div>