<?php

class AdministratorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='admin';

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
		$criteria=new CDbCriteria;
		// $criteria->addCondition('statusResumes_idStatusResume != 1');
		$status = Changelogstatus::model()->findAll($criteria);
		$dataprovider =  new CArrayDataProvider($status, array(
	    	'keyField'=>'idChangeLogStatus',
		    'sort'=>array(
		    	'defaultOrder'=>'idChangeLogStatus ASC',
		        'attributes'=>array(
		            'id'=>array(
		                'asc'=>'idChangeLogStatus asc',
		                'desc'=>'idChangeLogStatus desc',
		            ),
		            'stateOld'=>array(
		                'asc'=>'thisStatusOld.state asc',
		                'desc'=>'thisStatusOld.state desc',
		            ),
		            'stateNew'=>array(
		                'asc'=>'thisStatusNew.state asc',
		                'desc'=>'thisStatusNew.state desc',
		            ),
		            'date'=>array(
		                'asc'=>'date asc',
		                'desc'=>'date desc',
		            ),
		            'employee'=>array(
		                'asc'=>'employeesIdEmployee.name asc',
		                'desc'=>'employeesIdEmployee.name desc',
		            ),
		            'rol'=>array(
		                'asc'=>'employeesRolesIdRol.name asc',
		                'desc'=>'employeesRolesIdRol.name desc',
		            ),
	            ),
            ),
            'pagination'=>array(
            	'pageSize'=>10
			),
		));
		$this->render('changelog',array(
			'dataprovider'=>$dataprovider,
		));
	}

	public function actionSearchChangelog(){

		$criteria = new CDbCriteria;
		if(isset($_POST['daterange']) && $_POST['daterange']!=''){
			$dates = explode('to',$_POST['daterange']);
			$dateStart = $dates[0];
			$dateEnd = $dates[1];
			$dateStart = trim($dateStart);
			$dateEnd = trim($dateEnd);
			$dateStart = date('Y-m-d H:i:s', strtotime($dateStart));
			$dateEnd = date('Y-m-d H:i:s', strtotime($dateEnd));
			$criteria->addCondition("date between '".$dateStart."' and '".$dateEnd."'");
		}
		if(isset($_POST['keyword'])){
			$keyword = $_POST['keyword'];
			$criteria->with = array("employeesIdEmployee");
			$criteria->addCondition("employeesIdEmployee.name like '%".$keyword."%'");
		}
		// print_r($_POST);
		if(isset($_POST['StateOld'])){
		 	$criteria->addCondition("statusOld ='".$_POST['StateOld']."'");
		}
		if(isset($_POST['StateNew'])){
		 	$criteria->addCondition("statusNew ='".$_POST['StateNew']."'");
		}
		$logs = Changelogstatus::model()->findAll($criteria);
		$dataprovider =  new CArrayDataProvider($logs, array(
	    	'keyField'=>'idChangeLogStatus',
		    'sort'=>array(
		    	'defaultOrder'=>'idChangeLogStatus ASC',
		        'attributes'=>array(
		            'id'=>array(
		                'asc'=>'idChangeLogStatus asc',
		                'desc'=>'idChangeLogStatus desc',
		            ),
		            'stateOld'=>array(
		                'asc'=>'thisStatusOld.state asc',
		                'desc'=>'thisStatusOld.state desc',
		            ),
		            'stateNew'=>array(
		                'asc'=>'thisStatusNew.state asc',
		                'desc'=>'thisStatusNew.state desc',
		            ),
		            'date'=>array(
		                'asc'=>'date asc',
		                'desc'=>'date desc',
		            ),
		            'employee'=>array(
		                'asc'=>'employeesIdEmployee.name asc',
		                'desc'=>'employeesIdEmployee.name desc',
		            ),
		            'rol'=>array(
		                'asc'=>'employeesRolesIdRol.name asc',
		                'desc'=>'employeesRolesIdRol.name desc',
		            ),
	            ),
            ),
            'pagination'=>array(
            	'pageSize'=>10
			),
		));
		echo $this->renderPartial('_gridChangelog',array(
			'dataprovider'=>$dataprovider,
		),true);
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
		$criteria=new CDbCriteria;
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
		));

		$this->render("templates",array('dataprovider'=>$dataprovider));

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

	/**
	 * Performs the AJAX validation.
	 * @param Resumes $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='resumes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
