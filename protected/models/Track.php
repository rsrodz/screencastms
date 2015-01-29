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

class Track extends CActiveRecord {

  CONST PAGE_VIEW = 1;
  CONST FILE_VIEW = 2;
  CONST VIDEO_VIEW = 3;
  CONST LIKE = 4;
  CONST COMMENT_CREATE = 5;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Trac the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function addTrack($u,$rID,$uID,$tID){

	$t = new Track;
	$t->url = $u;
	$t->reportID = $rID;
	$t->typeID = $tID;
	$t->userID = $uID;
	$t->save();

    }
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_track';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('url, userID', 'required'),
            array('reportID, userID, typeID', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dateStamped', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => true, 'on' => 'insert'),
            array('url', 'safe', 'on' => 'search'),

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
      return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'dateStamped' => 'Date Stamped',
	    'url' => 'URL',
	    'reportID' => 'Report ID',
	    'userID' => 'User ID',
	    'typeID' => 'Type ID'
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
        $criteria->compare('dateStamped', $this->dateStamped, true);
        $criteria->compare('url', $this->url, true);
	$criteria->compare('reportID', $this->reportID);
	$criteria->compare('userID', $this->reportID);
	$criteria->compare('typeID', $this->typeID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
