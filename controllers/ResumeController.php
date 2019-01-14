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
		$request = Yii::$app->request;
		if ($request->isPost){
			if($request->post('action') && $request->post('resume-form')){
				print_r($_POST);
			}
		}
		$modelsSections = [new Sections];
		return $this->render('index', array('model'=>$resume, 'modelsSections'=>$modelsSections));
	}
}