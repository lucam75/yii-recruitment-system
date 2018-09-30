<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Resumes;

class ResumeController extends Controller
{
	public $layout='main';

	public function actionIndex()
	{
		$resume = new Resumes;
		return $this->render('index', array('model'=>$resume));
	}

	public function step2(){
		echo $this->renderPartial('step2');
	}
	public function step3(){
		echo $this->renderPartial('step3');
	}
	public function step4(){
		echo $this->renderPartial('step4');
	}
	public function step5(){
		$model = new Documents;
		$this->performAjaxValidation($model);
		echo $this->renderPartial('step5',array('model'=>$model));
	}
	public function stepSummary(){
		echo $this->renderPartial('summary');
	}
	public function actionDone()
	{
		$this->render('done');
	}
	public function actionFormEducation()
	{
		$this->layout = "modal";
		$model=new Education;
		$size = count(Yii::app()->session['Educations']);
		$model->idEducation = $size+1;
		$this->performAjaxValidation($model);
        $this->render('_formEducation',array('model'=>$model));
	}
	public function actionFormSection()
	{
		$type = $_POST["type"];
		$this->layout = "modal";
		$model=new Sections;
		$model->typeSection_idtypeSection = $type;
		if($type=='1'){
			$size = count(Yii::app()->session['Experiences']);
			$idForm = 'experience-form';
		}elseif ($type == '2') {
			$size = count(Yii::app()->session['Achievements']);
			$idForm = 'achievement-form';
		}elseif ($type == '3') {
			$size = count(Yii::app()->session['Hobbies']);
			$idForm = 'hobby-form';
		}elseif ($type == '4') {
			$size = count(Yii::app()->session['Interests']);
			$idForm = 'interest-form';
		}elseif ($type == '5') {
			$size = count(Yii::app()->session['References']);
			$idForm = 'reference-form';
		}
		$model->idSection = $size;
		$this->performAjaxValidation($model);
        echo $this->render('_formSections',array('model'=>$model,'idForm'=>$idForm));
	}

	public function actionAdminEducation(){
		if(isset($_POST["Education"])){ //adding new
			$education = new Education;
			$education->idEducation = $_POST["Education"]["idEducation"];
			$education->startYear = $_POST["Education"]["startYear"];
			$education->endYear = $_POST["Education"]["endYear"];
			$education->place = $_POST["Education"]["place"];
			$education->title = $_POST["Education"]["title"];
			$education->description = $_POST["Education"]["description"];
		  	$temp = Yii::app()->session['Educations'];
	        $temp[] = $education;
	        Yii::app()->session['Educations'] = $temp;
    	}
    	if(isset($_POST["idEducation"])){ //deleting something
    		$temp = Yii::app()->session['Educations'];
			foreach ($temp as $key => $value) {
				if($value->idEducation == $_POST["idEducation"]){
					unset($temp[$key]);
					break;
				}
			}
			Yii::app()->session['Educations'] = $temp;
    	}
		echo $this->renderPartial('_listEducations',true);

	}

	public function actionAdminSection(){
		$session = $_POST["Session"];
		if(isset($_POST["Sections"])){ //adding new
			$section = new Sections;

			$section->idSection = $_POST["Sections"]["idSection"];
			$section->header = $_POST["Sections"]["header"];
			$section->description = $_POST["Sections"]["description"];
			$section->typeSection_idtypeSection = $_POST["Sections"]["typeSection_idtypeSection"];

		  	$temp = Yii::app()->session[$session];
	        $temp[] = $section;
	        Yii::app()->session[$session] = $temp;
    	}
    	if(isset($_POST["idSection"])){ //deleting something
    		$temp = Yii::app()->session[$session];
			foreach ($temp as $key => $value) {
				if($value->idSection == $_POST["idSection"]){
					unset($temp[$key]);
					break;
				}
			}
			Yii::app()->session[$session] = $temp;
    	}
        echo $this->renderPartial('_listSections',array('session'=>$session),true);
	}
	public function actionSaveFiles(){
		if(!isset($_POST["idResume"])) return false;
		if(empty($_FILES)){ echo "yes."; return true; }
		$idResume = $_POST["idResume"];
		if(!is_dir(Yii::getPathOfAlias('webroot').'/attaches/'.$idResume.'/')) {
		   mkdir(Yii::getPathOfAlias('webroot').'/attaches/'.$idResume.'/', 0755,true);
		}
		$errors = array();
    	for ($i=0; $i < count($_FILES['document']["name"]); $i++) {
    			$name = $_FILES['document']["name"][$i];
				move_uploaded_file($_FILES['document']["tmp_name"][$i],
			      Yii::getPathOfAlias('webroot').'/attaches/'.$idResume.'/'.$name);
				$document = new Documents;
                $document->document = 'attaches/'.$idResume.'/'.$name;

                $name = str_replace(".", '_', $name);
                $name = str_replace(" ", '_', $name);
                $document->description = $_POST[$name];
				$document->type = $_FILES['document']["type"][$i];
				$document->resumes_idResume = $idResume;

                // $document->save(); // DONE
				if (!$document->save()) {
					$errors[] = $document->getErrors();
				}
			// }
   		}
		if(!empty($errors)){
			$toPrint = '';
			foreach ($resume->getErrors() as $vector) {
				foreach ($vector as $error) {
						$toPrint.=$error."<br>";
				}
			}
			echo $toPrint;
		}else{
			echo "yes.";
		}
	}//end savefiles
	public function actionSend()
	{
		if(isset($_POST["Resumes"])){
			$resume = new Resumes;
			$resume->attributes = $_POST["Resumes"];
			$resume->dateApplication = date('Y-m-d H:i:s');
			$resume->statusResumes_idStatusResume = '1';
			$errors = array();
			if($resume->save()){
				$list = Yii::app()->session['Educations'];
				foreach ($list as $key) {
					$model = new Education;
					$model = $key;
					$model->resumes_idResume = $resume->idResume;
					$model->idEducation = '';
					if(!$model->save()){
						$errors[] = $model->getErrors();
					}
				}
				$list = Yii::app()->session['Experiences'];
				foreach ($list as $key) {
					$model = new Sections;
					$model = $key;
					$model->resumes_idResume = $resume->idResume;
					$model->idSection = '';
					if(!$model->save()){
						$errors[] = $model->getErrors();
					}
				}
				$list = Yii::app()->session['Achievements'];
				foreach ($list as $key) {
					$model = new Sections;
					$model = $key;
					$model->resumes_idResume = $resume->idResume;
					$model->idSection = '';
					if(!$model->save()){
						$errors[] = $model->getErrors();
					}
				}
				$list = Yii::app()->session['Hobbies'];
				foreach ($list as $key) {
					$model = new Sections;
					$model = $key;
					$model->resumes_idResume = $resume->idResume;
					$model->idSection = '';
					if(!$model->save()){
						$errors[] = $model->getErrors();
					}
				}
				$list = Yii::app()->session['Interests'];
				foreach ($list as $key) {
					$model = new Sections;
					$model = $key;
					$model->resumes_idResume = $resume->idResume;
					$model->idSection = '';
					if(!$model->save()){
						$errors[] = $model->getErrors();
					}
				}
				$list = Yii::app()->session['References'];
				foreach ($list as $key) {
					$model = new Sections;
					$model = $key;
					$model->resumes_idResume = $resume->idResume;
					$model->idSection = '';
					if(!$model->save()){
						$errors[] = $model->getErrors();
					}
				}
				$list = Yii::app()->session['Documents'];
				foreach ($list as $key) {
					$model = new Sections;
					$model = $key;
					$model->resumes_idResume = $resume->idResume;
					$model->idSection = '';
					if(!$model->save()){
						$errors[] = $model->getErrors();
					}
				}

				//save the profile picture
				if(isset($_POST["picture"])){
					$idResume = $resume->idResume;
					if(!is_dir(Yii::getPathOfAlias('webroot').'/attaches/'.$idResume.'/')) {
					   mkdir(Yii::getPathOfAlias('webroot').'/attaches/'.$idResume.'/', 0755,true);
					}
	    			$name = $_FILES['Resumes']["name"]["picture"];
					move_uploaded_file($_FILES['Resumes']["tmp_name"]["picture"],
				      Yii::getPathOfAlias('webroot').'/attaches/'.$idResume.'/'.$name);
	                $resume->picture = 'attaches/'.$idResume.'/'.$name;
	                // $document->save(); // DONE
					if (!$resume->save()) {
						$errors[] = $model->getErrors();
					}
				}
				if(!empty($errors)){
					foreach ($errors as $vector) {
						foreach ($vector as $error) {
								$toPrint.=$error."<br>";
						}
					}
					echo $toPrint;
				}else{
					echo "success//".$resume->idResume;
				}
			}else{
				$toPrint = '';
					foreach ($resume->getErrors() as $vector) {
						foreach ($vector as $error) {
								$toPrint.=$error."<br>";
						}
					}
					echo $toPrint;
			}
			Yii::app()->session['Resume'] = $resume;
		}
	}

	public function actionCitiesByCountries(){

		$idCountry = $_POST["idCountry"];

		$cities = Cities::model()->findAll(array('order'=>'name ASC', 'condition'=>'countries_idCountry=:x', 'params'=>array(':x'=>$idCountry)));

		$listData = CHtml::listData($cities, 'idCity', 'name');

		foreach ($listData as $key => $value) {
			echo '<option value="'.$key.'">'.$value.'</option>';
		}
	}
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
	/**
	 * Performs the AJAX validation.
	 * @param Persona $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}