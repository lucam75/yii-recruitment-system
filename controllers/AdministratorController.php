<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Resumes;
use app\models\Statusresumes;
use app\models\Changelogstatus;
use app\models\Employees;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\mpdf\Pdf;

class AdministratorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='admin-layout';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('Changelog','SearchChangelog','Statistics','Templates','CKEditor','SaveTemplate'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	protected function stateOld($data){
		$state = $data["thisStatusOld"]["state"];
		return $this->spanState($state);
	}
	protected function stateNew($data){
		$state = $data["thisStatusNew"]["state"];
		return $this->spanState($state);
	}
	public function spanState($state){
		switch ($state) {
			case 'New':
				return '<span class="label label-primary">'.Yii::t('app',$state).'</span>';
				break;
			case 'Pending':
				return '<span class="label label-warning">'.Yii::t('app',$state).'</span>';
				break;
			case 'Called':
				return '<span class="label label-success">'.Yii::t('app',$state).'</span>';
				break;
			case 'Rejected':
				return '<span class="label label-danger">'.Yii::t('app',$state).'</span>';
				break;
			default:
				return Yii::t('app',$state);
				break;
		}
	}
	public function colorState($state){
		switch ($state) {
			case 'New':
				return '#007fff';
				break;
			case 'Pending':
				return '#ff7518';
				break;
			case 'Called':
				return '#3fb618';
				break;
			case 'Rejected':
				return '#ff0039';
				break;
			default:
				return Yii::t('app',$state);
				break;
		}
	}
	public function actionChangelog(){

		$request = Yii::$app->request;
		$query = Changelogstatus::find();

		if ($request->isPost){
			if($request->post('daterange')){
				$dates = explode('to',$_POST['daterange']);
				$dates[0] = str_replace('/', '-', $dates[0]);
				$dates[1] = str_replace('/', '-', $dates[1]);
				$dateStart = date('Y-m-d H:i:s', strtotime(trim($dates[0])));
				$dateEnd = date('Y-m-d H:i:s', strtotime(trim($dates[1])));
				$query->andWhere(['BETWEEN', "date", $dateStart, $dateEnd]);
			}
			if($request->post('keyword')){
				$keyword = $_POST['keyword'];
				$query->innerJoin('employees', '`employees_idEmployee` = `idEmployee`')->andWhere(['LIKE', 'name', $keyword]);
			}

			if($request->post('StateOld')){
				 $query->andWhere(['=',"statusOld", $_POST['StateOld']]);
			}
			if($request->post('StateNew')){
				$query->andWhere(['=',"statusNew", $_POST['StateNew']]);
		   }
		}

		$dataProvider =  $this->GenerateDataProvider($query);

		return $this->render('changelog',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionStatistics(){
		$status = Statusresumes::model()->findAll();
		$total = 0;
		foreach ($status as $key) {
			$total+=count($key->resumes);
		}
		foreach ($status as $key) {
			$dataset1[] = array(
				"value"=>(count($key->resumes)/$total) * 100,
				"color"=>$this->colorState($key->state),
				"label"=>$key->state." ".round(((count($key->resumes)/$total) * 100),2)."%"
			);
		}

		$criteria=new CDbCriteria;
        $criteria->distinct = true;
        $criteria->select = array('region');
		$regions = Countries::model()->findAll($criteria);
		$totalCountry = 0;
		$totalRegion = 0;
        $dataset2 = array();
        $labels2 = array();
		foreach ($regions as $region) {
			$totalRegion = 0;
			$countries = Countries::model()->findAll(array('condition'=>'region = "'.$region->region.'"'));
			foreach ($countries as $country) {
				$totalCountry = 0;
				foreach ($country->cities as $city) {
					$totalCountry+=count($city->resumes);
				}
				$totalRegion+=$totalCountry;
			}
			$dataset2[]=$totalRegion;
			$labels2[]=$region->region;
		}
		$this->render('statistics',array('dataset1'=>$dataset1,'dataset2'=>$dataset2,'labels2'=>$labels2));
	}

	public function actionTemplates(){

		$query = Statusresumes::find()->where(['!=','idStatusResume','1']);
		$dataProvider =  new ActiveDataProvider([
			'query' => $query,
            'pagination'=>[
            	'pageSize'=>10
			],
		]);
		/*$criteria=new CDbCriteria;
		$criteria->addCondition('idStatusResume != 1');
		$status = Statusresumes::model()->findAll($criteria);
		$dataprovider =  new CArrayDataProvider($status, array(
	    	'keyField'=>'idStatusResume',
		    'sort'=>array(
		    	'defaultOrder'=>'idStatusResume ASC',
		        'attributes'=>array(
		            'template'=>array(
		                'asc'=>'templateEmail asc',
		                'desc'=>'templateEmail desc',
		            ),
	            ),
            ),
            'pagination'=>array(
            	'pageSize'=>10
			),
		));*/

		return $this->render("templates",array('dataProvider'=>$dataProvider));

	}
	public function actionCKEditor(){
		$model = Statusresumes::model()->findByPk($_POST["idStatusResume"]);
		$this->renderPartial("ckeditor",array('model'=>$model));
	}
	public function actionSaveTemplate(){
		// SaveTemplate",{idResume:id,Template:template}
		if(isset($_POST["idStatusResume"]) && isset($_POST["Template"])){
			$model = Statusresumes::model()->findByPk($_POST["idStatusResume"]);
			$model->templateEmail = $_POST["Template"];
			if(!$model->save()){
				print_r($model->getErrors());
			}else{
				echo "success";
			}
		}
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Resumes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Resumes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function GenerateDataProvider($query){
		$dataProvider =  new ActiveDataProvider([
			'query' => $query,
            'pagination'=>[
            	'pageSize'=>10
			],
		]);

		$dataProvider->setSort([
			'attributes' => [
				'stateOld' => [
					'asc' => ['stateOld' => SORT_ASC],
					'desc' => ['stateOld' => SORT_DESC],
					'default' => SORT_ASC
				],
				'stateNew' => [
					'asc' => ['stateNew' => SORT_ASC],
					'desc' => ['stateNew' => SORT_DESC],
					'default' => SORT_ASC,
				],
				'date' => [
					'asc' => ['date' => SORT_ASC],
					'desc' => ['date' => SORT_DESC],
					'default' => SORT_ASC,
				]
			],
		]);
		return $dataProvider;
	}
}
