<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Resumes;
use app\models\Sections;

class ResumeController extends Controller
{
	public $layout='main';

	public function actionIndex()
	{
		$resume = new Resumes;
		$resume->maritalStatus_idMaritalStatus = 1;
		$resume->cities_idCity = 1;
		$resume->statusResumes_idStatusResume = 1;
		$modelsSections = [new Sections];

		if ($resume->load(Yii::$app->request->post())) {
			if($resume->save())
            {
				Yii::$app->session->setFlash('success', Yii::t('app', 'Your resume was saved.'));
				$resume = new Resumes;
				return $this->redirect(['resume/thankyou']);
            }
            else
            {
				$errors = '';
				foreach ($resume->getErrors() as $vector) {
					foreach ($vector as $error) {
							$errors.=$error."<br>";
					}
				}
				Yii::$app->session->setFlash('error', $errors);
            }
		}

		return $this->render('index', array('model'=>$resume, 'modelsSections'=>$modelsSections));
	}

	public function actionThankyou(){
		return $this->render('done');
	}
}