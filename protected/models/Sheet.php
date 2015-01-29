<?php

/**
 * This is the model class for table "tbl_sheet".
 *
 * The followings are the available columns in table 'tbl_sheet':
 * @property integer $id
 * @property integer $reportID
 * @property integer $userID
 * @property string $sheetUrl
 * @property string $dateCreated
 * @property string $description
 * @property integer $likeCount
 */
class Sheet extends CActiveRecord {

    public $sheetFile="";
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sheet the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_sheet';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sheetUrl', 'required'),
            array('reportID, userID, likeCount', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dateCreated', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            array('description', 'safe', 'on' => 'search'),
            array('sheetFile', 'file', 'types'=>'pdf, jpg, tiff, png, doc, docx, xls, xlsx, ppt, pptx', 'allowEmpty'=>true)
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'report' => array(self::BELONGS_TO, 'Report', 'reportID'),
            'author' => array(self::BELONGS_TO, 'User','userID')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'reportID' => 'Report',
            'userID' => 'User',
            'sheetUrl' => 'Sheet Url',
            'dateCreated' => 'Date Created',
            'description' => 'Description',
            'likeCount' => 'Like Count',
            'name' => 'File name'
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
        $criteria->compare('reportID', $this->reportID);
        $criteria->compare('name', $this->name);
        $criteria->compare('userID', $this->userID);
        $criteria->compare('sheetUrl', $this->sheetUrl, true);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('likeCount', $this->likeCount);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
