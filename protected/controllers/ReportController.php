<?php

class ReportController extends Controller {

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
		  'actions' => array('index','fetch', 'view','create', 'update','like','delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * sends a file based on token.  returns file not found if token is invalid
     */
    public function actionFetch($t){

      $tURI = URIToken::model()->accessToken($t);

      if ($tURI){
	$filePath = '/mdcast/'.$tURI;
	
	
        $this->renderPartial('fetch', array(
					    'filePath' => $filePath
					    ));
      }else {
	throw new CHttpException(404,'The specified resource cannot be found.');
      }

    }
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $commentModel = new Comment;
        $commentModel->reportID = $id;
        
        $comments = $this->loadModel($id)->comments;
        
        $sheets = $this->loadModel($id)->sheets;

	Track::model()->addTrack(Yii::app()->request->requestUri,$id, Yii::app()->user->id, Track::PAGE_VIEW);

	$model = $this->loadModel($id);

	$tokenURI = URIToken::model()->generateToken($model->videoUrl);
	
        $this->render('view', array(
				    'model' => $model,
				    'token' => $tokenURI,
				    'comments' => $comments,
				    'commentModel' => $commentModel,
				    'sheets'=> $sheets,
        ));
    }

    public function actionLike($id){
        $m = $this->loadModel($id);
        $m->likeCount = $m->likeCount + 1;
        $m->save();
        
	Track::model()->addTrack(Yii::app()->request->requestUri,$id, Yii::app()->user->id, Track::LIKE);

        $this->redirect(Yii::app()->user->returnUrl);
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        
        if (!User::isAdmin())
            throw new CHttpException(400, 'Invalid request. You do dont have the credentials to perform this action.');
        
        $model = new Report;

        $c = new CDbCriteria;
        $c->order = "lastName ASC";
        $pAll = User::model()->findAll($c);
        $presenters = array();
        foreach ($pAll as $p)
            $presenters[$p->id] = $p->lastName . ", " . $p->firstName;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Report'])) {
            $model->attributes = $_POST['Report'];
            $report = new Report;

            $saveString = '';
            $model->videoFile = CUploadedFile::getInstance($model, 'videoFile');
            if (isset($model->videoFile)) {
                $saveString = 'videos/' . CTimestamp::formatDate('mmddyyss') . "." . $model->videoFile->extensionName;
                $model->videoFile->saveAs($saveString);
            }
            

            $report->dateRecorded = date('Y-m-d H:i:s',strtotime($model->dateRecorded));
            $report->presenterID = $model->presenterID;
            $report->title = $model->title;
            $report->videoUrl = $saveString;
                    
            if ($report->save())
                $this->redirect(array('view', 'id' => $report->id));
        }

        $this->render('create', array(
            'model' => $model,
            'presenters' => $presenters,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        
        if ($model->presenterID != User::currentUser()->id && !User::isAdmin())
            throw new CHttpException(400, 'Invalid request. You do dont have the credentials to perform this action.');
        
        $sheet = new Sheet;
        $sheets = $this->loadModel($id)->sheets;

        $c = new CDbCriteria;
        $c->order = "lastName ASC";
        $pAll = User::model()->findAll($c);
        $presenters = array();
        foreach ($pAll as $p)
            $presenters[$p->id] = $p->lastName . ", " . $p->firstName;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Report'])) {
            $model->attributes = $_POST['Report'];
            $model->dateRecorded = date('Y-m-d H:i:s',strtotime($model->dateRecorded));
            
            $saveString = $model->videoUrl;

            $model->videoFile = CUploadedFile::getInstance($model, 'videoFile');
            if (isset($model->videoFile)) {
                $saveString = 'videos/' . CTimestamp::formatDate('mmddyyss') . "." . $model->videoFile->extensionName;
                $model->videoFile->saveAs($saveString);
            }

            $model->videoUrl = $saveString;
            
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
            'sheet' => $sheet,
            'presenters' => $presenters,
            'sheets' => $sheets
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        
        $s = $this->loadModel($id);
        
        if (($s->presenterID != Yii::app()->user->id) && (User::isAdmin()==false))
            throw new CHttpException(400, 'Invalid request. You do dont have the credentials to perform this action.');
            
        $s->delete();

        $this->redirect(array('report/index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
	Track::model()->addTrack(Yii::app()->request->requestUri,0, Yii::app()->user->id, Track::PAGE_VIEW);
        $dataProvider = new CActiveDataProvider('Report',
						array('pagination'=>false,
						      'criteria' => array(
									  'order' => 'dateRecorded DESC')));
        $this->render('index', array(
				     'dataProvider' => $dataProvider,
				     ));
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Report::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'report-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
