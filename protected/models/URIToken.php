<?php

/**
 * This is the model class for table "tbl_uritoken".
 *
 */


class URIToken extends CActiveRecord{


    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Trac the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    /**
     * Returns a token which can be later used to retrieve a 
     * URI
     *  @param string $refURI - the URI which will be requested
     *  @return string $token - a token which will be handeled by the
     *    token controller to get a URI
     */
    public static function generateToken($rURI){
  $secret = "42fi3rvb2oir4c82ui3b3rfk3fdso1";
      $t = new URIToken;
      $token = md5($secret . $rURI. time());
      $t->token = $token;
      $t->refURI = $rURI;
      $t->save();
      return $token;

    }

    /**
     * Returns the uri for a specific token.  The token is deleted from the 
     * db before the uri is returned.
     */
    public static function accessToken($token){
      $t = URIToken::model()->find('token=:token',array('token'=>$token));

      if ($t){
	$uri = $t->refURI;
	$t->delete();
	return $uri;
      } else
	return false;
      
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_uritoken';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('token,refURI', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dateCreated', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => true, 'on' => 'insert'),

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
      return array();
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
