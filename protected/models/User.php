<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property integer $userStatus
 * @property string $dateCreated
 * @property string $lastLogin
 * @property string $username
 * @property string $password
 */
class User extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, firstName, lastName, userStatus, username, password', 'required'),
            array('userStatus', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dateCreated,lastLogin', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            array('id, email, firstName, lastName, userStatus, dateCreated, lastLogin, username, password', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'reports' => array(self::HAS_MANY, 'Report', 'presenterID',
                'order' => 'reports.dateRecorded DESC'),
            'sheets' => array(self::HAS_MANY, 'Sheet', 'userID',
                'order' => 'sheets.dateCreated DESC')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'userStatus' => 'User Status',
            'dateCreated' => 'Date Created',
            'lastLogin' => 'Last Login',
            'username' => 'Username',
            'password' => 'Password',
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
        $criteria->compare('email', $this->email, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('lastName', $this->lastName, true);
        $criteria->compare('userStatus', $this->userStatus);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        $criteria->compare('lastLogin', $this->lastLogin, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function validatePassword($password) {
        return CPasswordHelper::verifyPassword($password, $this->password);
    }

    public function hashPassword($password) {
        return CPasswordHelper::hashPassword($password);
    }
    
    public function successfulLogin(){
        $this->lastLogin =  new CDbExpression('NOW()');
        $this->save();
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     * @return string the salt
     */
    protected function generateSalt() {
        return uniqid('', true);
    }

    public function getFullName() {
        return $this->firstName . " " . $this->lastName;
    }
    
    public static function currentUser(){
        if (Yii::app()->user->isGuest)
            return;
        
        return User::model()->findByPk(Yii::app()->user->id);
    }
    
    public static function isAdmin(){
        if (Yii::app()->user->isGuest)
           return false;
        
        $u = User::model()->findByPk(Yii::app()->user->id); 
        
        if ($u->userStatus == 1) 
            return true;
        
        return false;
    }
    
    public static function loggedIn(){
        return !Yii::app()->user->isGuest;
    }
    
}
