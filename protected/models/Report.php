<?php

/**
 * This is the model class for table "tbl_report".
 *
 * The followings are the available columns in table 'tbl_report':
 * @property integer $id
 * @property string $dateCreated
 * @property string $dateRecorded
 * @property string $title
 * @property integer $presenterID
 * @property string $videoUrl
 * @property integer $likeCount
 */
class Report extends CActiveRecord {

    public $videoFile="";
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Report the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_report';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dateRecorded, title, presenterID', 'required'),
            array('presenterID, likeCount', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dateCreated', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            array('videoUrl', 'default',
                'value' => '',
                'setOnEmpty' => false, 'on' => 'insert'),
            array('title', 'safe', 'on' => 'search'),
            array('videoFile', 'file', 'types'=>'mpg4, mov, wmv, mp4,avi', 'allowEmpty'=>true)
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'presenter' => array(self::BELONGS_TO, 'User', 'presenterID'),
            'comments' => array(self::HAS_MANY, 'Comment', 'reportID',
                'order' => 'comments.dateCreated DESC'),
            'sheets' => array(self::HAS_MANY, 'Sheet', 'reportID',
                'order' => 'sheets.dateCreated DESC')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'dateCreated' => 'Date Created',
            'dateRecorded' => 'Date of Report',
            'title' => 'Title',
            'presenterID' => 'Presenter',
            'videoUrl' => 'Video Url',
            'likeCount' => 'Like Count',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        $criteria->compare('dateRecorded', $this->dateRecorded, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('presenterID', $this->presenterID);
        $criteria->compare('videoUrl', $this->videoUrl, true);
        $criteria->compare('likeCount', $this->likeCount);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getUrl() {
        return Yii::app()->createUrl('report/view', array(
                    'id' => $this->id
        ));
    }
    
    public function getFullName(){
        $presenter = $this->presenter;
        return $presenter->getFullName();
    }

}
