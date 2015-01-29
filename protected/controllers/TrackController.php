<?php

class TrackController extends Controller {


    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/bootstrap';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
		  'actions' => array('index','addTrack'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionIndex() {
      Track::model()->deleteAll('userID=:userID',array(':userID'=>1));
        $dataProvider = new CActiveDataProvider('Track',
						array('pagination'=>false,
						      'criteria' => array(
									  'order' => 'dateStamped DESC')));
        $this->render('index', array(
				     'dataProvider' => $dataProvider,
				     ));
    }

    public function actionAddTrack($u,$r,$id,$t){
      $t = new Track;
      $t->url = $u;
      $t->reportID = $r;
      $t->typeID = $t;
      $t->userID = $id;
      $t->save();
      Yii::app()->end();      
    }
        
        /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Track::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'track-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
