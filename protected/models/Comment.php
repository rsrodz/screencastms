<?php

/**
 * This is the model class for table "tbl_comment".
 *
 * The followings are the available columns in table 'tbl_comment':
 * @property integer $id
 * @property integer $reportID
 * @property string $dateCreated
 * @property integer $userID
 * @property string $comment
 * @property integer $likeCount
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reportID, userID, comment', 'required'),
			array('reportID, userID, likeCount', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
                        array('dateCreated', 'default',
                            'value' => new CDbExpression('NOW()'),
                            'setOnEmpty' => false, 'on' => 'insert'),
			array('id, reportID, dateCreated, userID, comment, likeCount', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'author' => array(self::BELONGS_TO, 'User', 'userID'),
                    'report' => array(self::BELONGS_TO, 'Report','reportID')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'reportID' => 'Report',
			'dateCreated' => 'Date Created',
			'userID' => 'User',
			'comment' => 'Comment',
			'likeCount' => 'Like Count',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('reportID',$this->reportID);
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('likeCount',$this->likeCount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getAuthor(){
            $a = User::model()->findByAttributes(array('id'=>$this->userID));
            return $a->firstName ." ". $a->lastName;
            
        }
}