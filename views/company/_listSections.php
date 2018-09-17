<?php
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use app\models\Resumes;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model,
    'pagination' => false,
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_detailSection',
    'summary' => '',
    'emptyText' => '',
]);

?>