<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class CompanyController extends Controller
{
	public $layout='company';


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
				'actions'=>array('ManageResume','ViewSession','PDFSession','PDF','View','Index','Archived','SearchArchived'),
				'users'=>array('employee'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionManageResume(){
		if(isset($_POST["action"])){
			$action = $_POST["action"];
			$model = $this->loadModel(Yii::app()->session['idResume']);
			$statusOld = $model->statusResumes_idStatusResume;
			switch ($action) {
				case 'call':
					$model->statusResumes_idStatusResume = '3';
					break;
				case 'pending':
					$model->statusResumes_idStatusResume = '2';
				break;
				case 'reject':
					$model->statusResumes_idStatusResume = '4';
				break;
			}
			if(!$model->save(false)){
				print_r($model->getErrors());
			}else{

				Yii::import('application.extensions.phpmailer.JPhpMailer');
				$mail = new JPhpMailer;
				$mail->IsSMTP();
				$mail->Host = 'smtp.googlemail.com:465';
				$mail->SMTPSecure = "ssl";
				$mail->SMTPAuth = true;
				$mail->Username = 'recruitment.caniatech@gmail.com';
				$mail->Password = 'caniatech123';
				$mail->SetFrom('yourname@163.com', 'Recruitmen team');
				$mail->Subject = 'About your resume in our company';
				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer.';
				$message = $model->statusResumesIdStatusResume->templateEmail;
				$message.="<br />";
				$old = Statusresumes::model()->findByPk($statusOld);
				$message.="Old status: ".$old->state."<br />";
				$message.="New status: ".$model->statusResumesIdStatusResume->state."<br />";
				$mail->MsgHTML($message);
				$mail->AddAddress($model->email,$model->suffix." ".$model->firstName." ".$model->middleName." ".$model->lastName);
				$mail->Send();


				$log = new Changelogstatus;
			 	$log->statusOld = $statusOld;
			 	$log->statusNew = $model->statusResumes_idStatusResume;
			 	$log->date = date('Y-m-d H:i:s');
			 	$log->resumes_idResume = $model->idResume;
			 	$log->employees_idEmployee = Yii::app()->user->userid;
			 	$log->employees_roles_idRol = Yii::app()->user->useridrol;
			 	if(!$log->save()){
			 		print_r($log->getErrors());
			 	}else{
					echo "success";
				}
			}
		}
	}

	public function actionViewSession($id){
		Yii::app()->session['idResume'] = $id;
		$this->redirect(array("Company/View"));
	}
	public function actionPDFSession($id){
		Yii::app()->session['idResume'] = $id;
		$this->redirect(array("Company/PDF"));
	}
	public function actionPDF(){

			$this->layout='pdf';
			$mPDF1 = Yii::app()->ePdf->mpdf('c', 'Letter', 0, '', 40, 30, 40, 30, 0, 9, 'P');
			$mPDF1->SetDisplayMode('fullpage');

			$mPDF1->WriteHTML($this->render('viewPDF',array(
			'model'=>$this->loadModel(Yii::app()->session['idResume'])
		), true));

			$mPDF1->Output();
// $this->render('view',array('model'=>$this->loadModel(Yii::app()->session['idResume'])));
	}
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(Yii::app()->session['idResume'])
		));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('statusResumes_idStatusResume','1');
		$resumes = Resumes::model()->findAll($criteria);
		Yii::app()->session['newsResumes'] = count($resumes);
		$dataprovider =  new CArrayDataProvider($resumes, array(
	    	'keyField'=>'idResume',
		    'sort'=>array(
		    	'defaultOrder'=>'dateApplication ASC',
		        'attributes'=>array(
		        	'dateApplication',
		            'state'=>array(
		                'asc'=>'statusResumesIdStatusResume.state',
		                'desc'=>'statusResumesIdStatusResume.state desc',
		            ),
		            'applicant'=>array(
		                'asc'=>'firstName',
		                'desc'=>'firstName desc',
	            	),
	            ),
            ),
            'pagination'=>array(
            	'pageSize'=>10
			),
		));
		$this->render('index',array(
			'dataprovider'=>$dataprovider,
		));
	}
public function actionArchived()
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('statusResumes_idStatusResume != 1');
		$resumes = Resumes::model()->findAll($criteria);
		$dataprovider =  new CArrayDataProvider($resumes, array(
	    	'keyField'=>'idResume',
		    'sort'=>array(
		    	'defaultOrder'=>'dateApplication ASC',
		        'attributes'=>array(
		        	'dateApplication',
		            'state'=>array(
		                'asc'=>'statusResumesIdStatusResume.state',
		                'desc'=>'statusResumesIdStatusResume.state desc',
		            ),
		            'applicant'=>array(
		                'asc'=>'firstName',
		                'desc'=>'firstName desc',
	            	),
	            ),
            ),
            'pagination'=>array(
            	'pageSize'=>10
			),
		));
		$this->render('archived',array(
			'dataprovider'=>$dataprovider,
		));
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
	protected function state($data){
		$state = $data["statusResumesIdStatusResume"]["state"];
		return $this->spanState($state);
	}
	protected function optionsColumn($data) {
		$options = CHtml::link("<i class='fa fa-eye' style='color:black; margin-right:5px;' title='".Yii::t('app','View')."'></i>",array("ViewSession","id"=>$data['idResume']));
		$options.=CHtml::link("<i class='fa fa-file-text-o' style='color:black; margin-right:5px;' title='".Yii::t('app','PDF')."'></i>",array("PDFSession","id"=>$data['idResume']),array('target'=>'_blank'));
		// $options.="<i class='fa fa-trash-o Delete' style='cursor:pointer;' title='".Yii::t('app','Delete')."' id='".$data['idResume']."'></i>";
		return $options;
	}
	protected function optionDoc($data) {
		// $options = CHtml::link("<i class='fa fa-eye' style='color:black; margin-right:5px;' title='".Yii::t('app','View')."'></i>",array("ViewDoc","id"=>$data['idDocument']));
		// $document = Documents::model()->findByPk($data[]);
		// $options = CHtml::link("<i class='fa fa-eye' style='color:black; margin-right:5px;' title='".Yii::t('app','View')."'></i>",array());
		return CHtml::link(Yii::t('app','View'), Yii::app()->baseUrl .'/' . $data["document"],array('target'=>'_blank'));

		return '<a href="'.Yii::getPathOfAlias('webroot').'/'.$data["document"].'">Click</a>';
		// return $options;
	}
	public function actionSearchArchived(){

		$criteria = new CDbCriteria;
		if(isset($_POST['daterange']) && $_POST['daterange']!=''){
			$dates = explode('to',$_POST['daterange']);
			$dateStart = $dates[0];
			$dateEnd = $dates[1];
			$dateStart = trim($dateStart);
			$dateEnd = trim($dateEnd);
			$dateStart = date('Y-m-d H:i:s', strtotime($dateStart));
			$dateEnd = date('Y-m-d H:i:s', strtotime($dateEnd));
			$criteria->addCondition("dateApplication between '".$dateStart."' and '".$dateEnd."'");
		}
		if(isset($_POST['keyword'])){
			$keyword = $_POST['keyword'];
			$criteria->addCondition("suffix like '%".$keyword."%' or firstName like '%".$keyword."%' or middleName like '%".$keyword."%' or lastName like '%".$keyword."%'");
		}

		$states = '';
		if(isset($_POST['States'])){
		 	foreach ($_POST['States'] as $key => $value) {
		 		$states.=$value;
		 		$states.=',';
		 	}
		 	$states = rtrim($states,",");
		 	$criteria->addCondition("statusResumes_idStatusResume IN (".$states.")");
		}
		$criteria->addCondition('statusResumes_idStatusResume != 1');
		$resumes = Resumes::model()->findAll($criteria);
		$dataprovider =  new CArrayDataProvider($resumes, array(
	    	'keyField'=>'idResume',
		    'sort'=>array(
		    	'defaultOrder'=>'dateApplication ASC',
		        'attributes'=>array(
		        	'dateApplication',
		            'state'=>array(
		                'asc'=>'statusResumesIdStatusResume.state',
		                'desc'=>'statusResumesIdStatusResume.state desc',
		            ),
		            'applicant'=>array(
		                'asc'=>'firstName',
		                'desc'=>'firstName desc',
	            	),
	            ),
            ),
            'pagination'=>array(
            	'pageSize'=>10
			),
		));
		echo $this->renderPartial('_gridArchived',array(
			'dataprovider'=>$dataprovider,
		),true);
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
