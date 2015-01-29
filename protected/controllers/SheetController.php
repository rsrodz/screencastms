<?php

class SheetController extends Controller {

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
                'actions' => array('create','delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        
        $model = new Sheet;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Sheet'])) {
            $model->attributes = $_POST['Sheet'];

            $saveString = '';
            $name = '';
            $model->sheetFile = CUploadedFile::getInstance($model, 'sheetFile');
            if (isset($model->sheetFile)) {
                $saveString = 'sheets/' . CTimestamp::formatDate('mmddyyss') . "." . $model->sheetFile->extensionName;
                $model->sheetFile->saveAs($saveString);
                $name = $model->sheetFile->name;
            }
            $model->name = $name;
            $model->sheetUrl = $saveString;

            if (!User::isAdmin() && !User::loggedIn())
        
            throw new CHttpException(400, 'Invalid request. You do dont have the credentials to perform this action.');
        
            
            if ($model->save())
                $this->redirect(array('report/update', 'id' => $model->reportID));
        }
        
        throw new CHttpException(400, 'Invalid request. Access creating a document through a specific lecture update.');
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $s = $this->loadModel($id);
        $r = $s->reportID;
        if ($s->userID == Yii::app()->user->id || User::isAdmin())
            $s->delete();

        $this->redirect(array('report/update', 'id' => $r));
            
    }

    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Sheet::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sheet-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
