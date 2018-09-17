<?php
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use app\models\Resumes;

if(!empty($model)){

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model,
        'pagination' => false,
    ]);
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_detailEducation',
        'summary' => '',
        'emptyText' => '',
        'itemOptions' => ['tag'=>false],
        'options' => ['tag'=>false]
    ]);
}
?>