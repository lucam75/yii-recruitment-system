<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Resumes;
use app\models\Changelogstatus;
use app\models\Employees;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\mpdf\Pdf;

class CompanyController extends Controller
{
	public $layout='company-layout';

	public function actionManageresume(){
		$request = Yii::$app->request;
		if ($request->isPost){
			if($request->post('action') && $request->post('idresume')){
				try{
					$action = $request->post('action');
					$idResume = $request->post('idresume');
					$model = $this->loadModel($idResume);
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
						$message = $model->statusResumesIdStatusResume->templateEmail;
						$message.="<br />";
						$message.="Old status: ".$statusOld."<br />";
						$message.="New status: ".$model->statusResumesIdStatusResume->state."<br />";

						Yii::$app->mailer->compose()
						->setFrom('from@domain.com')
						->setTo($model->email)
						->setSubject('About your resume in our company')
						->setTextBody($message)
						->setHtmlBody($message)
						->send();

						$employee = new Employees();
                		$loggedEmployee = $employee->findById(Yii::$app->user->id);
                		$loggedUserRoleId = $loggedEmployee->roles_idRol;

						$log = new Changelogstatus();
						$log->statusOld = $statusOld;
						$log->statusNew = $model->statusResumes_idStatusResume;
						$log->date = date('Y-m-d H:i:s');
						$log->resumes_idResume = $model->idResume;
						$log->employees_idEmployee = Yii::$app->user->id;
						$log->employees_roles_idRol = $loggedUserRoleId;
						if(!$log->save()){
							print_r($log->getErrors());
						}else{
							echo "success";
						}
					}
				}catch(\Exception $ex){
					var_dump($ex->getMessage());
					die();
				}
			}
		}
	}

	public function actionPdf($id){
		
		$model = $this->loadModel($id);
		$this->view->title = $model->compositename." - Resume";
		$content = $this->renderPartial('viewPDF',array('model'=>$model));

		// setup kartik\mpdf\Pdf component
		$pdf = new Pdf([
			// set to use core fonts only
			'mode' => Pdf::MODE_CORE, 
			// A4 paper format
			'format' => Pdf::FORMAT_A4, 
			// portrait orientation
			'orientation' => Pdf::ORIENT_PORTRAIT, 
			// stream to browser inline
			'destination' => Pdf::DEST_BROWSER, 
			// your html content input
			'content' => $content,  
			// format content from your own css file if needed or use the
			// enhanced bootstrap css built by Krajee for mPDF formatting 
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
			// any css to be embedded if required
			// 'cssInline' => '.kv-heading-1{font-size:18px}', 
			// set mPDF properties on the fly
			'options' => ['title' => 'Resume for '.$model->compositename],
			// call mPDF methods on the fly
			'methods' => [ 
				'SetHeader'=>[Yii::$app->name], 
				'SetFooter'=>['{PAGENO}'],
			],
			'filename' => $model->compositename." - Resume.pdf"
		]);
		
		// return the pdf output as per the destination setting
		Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

		$headers = Yii::$app->response->headers;
	
		$headers->add('Content-Type', 'application/pdf');
	
		return $pdf->render(); 
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->view->title = $model->compositename." - View Resume";
		return $this->render('view',array(
			'model'=>$model));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->view->title = Yii::t('app','Incoming resumes');
		$searchModel = new Resumes();
		$query = Resumes::find()->where(['statusResumes_idStatusResume'=>'1']);
		
		$dataProvider = $this->GenerateResumesDataProvider($query);

		return $this->render('index',array(
			'dataProvider'=>$dataProvider,'searchModel' => $searchModel,
		));
	}

	public function actionArchived()
	{
		$this->view->title = Yii::t('app','Archived resumes');
		$request = Yii::$app->request;
		$searchModel = new Resumes();
		$query = Resumes::find()->where(['<>','statusResumes_idStatusResume','1']);

		if ($request->isPost){
			if($request->post('daterange')){
				$dates = explode('to',$_POST['daterange']);
				$dates[0] = str_replace('/', '-', $dates[0]);
				$dates[1] = str_replace('/', '-', $dates[1]);
				$dateStart = date('Y-m-d H:i:s', strtotime(trim($dates[0])));
				$dateEnd = date('Y-m-d H:i:s', strtotime(trim($dates[1])));
				$query->andWhere(['BETWEEN', "dateApplication", $dateStart, $dateEnd]);
			}
			if($request->post('keyword')){
				$keyword = $_POST['keyword'];
				$query->andWhere(['or',
					['LIKE', 'suffix', $keyword],
					['LIKE', 'firstName', $keyword],
					['LIKE', 'middleName', $keyword],
					['LIKE', 'lastName', $keyword]
				]);
			}
	
			$states = '';
			if($request->post('States')){
				 foreach ($_POST['States'] as $key => $value) {
					 $states.=$value;
					 $states.=',';
				 }
				 $states = rtrim($states,",");
				 $query->andWhere(['IN', "statusResumes_idStatusResume", $states]);
			}
		}
		
		$dataProvider = $this->GenerateResumesDataProvider($query);

		return $this->render('archived',array(
			'dataProvider'=>$dataProvider,'searchModel' => $searchModel,
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

	public function optionscolumn($data) {
		$options = Html::a("<i class='fa fa-eye' style='color:black; margin-right:5px;' title='".Yii::t('app','View')."'></i>",["view","id"=>$data['idResume']]);
		$options.= Html::a("<i class='fa fa-file-text-o' style='color:black; margin-right:5px;' title='".Yii::t('app','PDF')."'></i>",["pdf","id"=>$data['idResume']],['target'=>'_blank','data-pjax'=>"0"]);
		return $options;
	}

	public function optiondoc($data) {
		return Html::a(Yii::t('app','View'), Url::base() .'/' . $data["document"],array('target'=>'_blank'));
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
		$model=Resumes::findOne($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function GenerateResumesDataProvider($query){
		$dataProvider =  new ActiveDataProvider([
			'query' => $query,
            'pagination'=>[
            	'pageSize'=>10
			],
		]);

		$dataProvider->setSort([
			'attributes' => [
				'statusResumes_idStatusResume' => [
					'asc' => ['statusResumes_idStatusResume' => SORT_ASC],
					'desc' => ['statusResumes_idStatusResume' => SORT_DESC],
					'default' => SORT_ASC
				],
				'firstName' => [
					'asc' => ['firstName' => SORT_ASC],
					'desc' => ['firstName' => SORT_DESC],
					'default' => SORT_ASC,
				],
				'dateApplication' => [
					'asc' => ['dateApplication' => SORT_ASC],
					'desc' => ['dateApplication' => SORT_DESC],
					'default' => SORT_ASC,
				]
			],
		]);

		return $dataProvider;
	}
}
