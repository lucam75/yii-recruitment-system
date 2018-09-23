<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Resumes;
use app\models\Statusresumes;
use app\models\Countries;
use app\models\Changelogstatus;
use app\models\Employees;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\mpdf\Pdf;

class AdministratorController extends Controller
{
	public $layout='admin-layout';

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
		$status = Statusresumes::find()->All();
		$totalResumes = count(Resumes::find()->all());

		$dataset = [];
		if($totalResumes != 0){
			foreach ($status as $key) {
				$dataset[] = array(
					"value"=>round((((count($key->resumes)/$totalResumes) * 100)), 2),
					"color"=>$this->colorState($key->state),
					"label"=>Yii::t('app',$key->state)
				);
			}
		}

		return $this->render('statistics',array('dataset'=>$dataset));
	}

	public function actionTemplates(){

		$request = Yii::$app->request;
		if ($request->isPost){
			if($request->post('Statusresumes')){
				$statusResume = Statusresumes::find()->where(['idStatusResume' => $request->post()['Statusresumes']['idStatusResume']])->one();
				$statusResume->templateEmail = $request->post()['Statusresumes']['templateEmail'];
				if ($statusResume->validate()) {
					if(!$statusResume->update()){
						print_r($statusResume->getErrors());
					}else{
						echo "success";
					}			
				}else{
					print_r($statusResume->getErrors());
				}			
			}
		}
		$query = Statusresumes::find()->where(['!=','idStatusResume','1']);
		$dataProvider =  new ActiveDataProvider([
			'query' => $query,
            'pagination'=>[
            	'pageSize'=>10
			],
		]);

		return $this->render("templates",array('dataProvider'=>$dataProvider));

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
