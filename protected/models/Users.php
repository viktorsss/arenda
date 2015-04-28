<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $created
 * @property integer $state
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string $name
 * @property string $so_name
 * @property string $otchestvo
 * @property string $e_mail
 * @property string $phone
 * @property string $organization
 * @property string $codeReg
 * @property string $codeDate
 * @property string $parag1_name
 * @property string $parag2_name
 * @property string $parag1_text
 * @property string $parag2_text
 * @property string $city
 * @property string $skype
 * @property string $icq
 * @property string $photo
 */
class Users extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('password, e_mail', 'required'),
	    array('state', 'numerical', 'integerOnly' => true),
	    array('username', 'length', 'max' => 10),
	    array('password, organization', 'length', 'max' => 50),
	    array('role', 'length', 'max' => 6),
	    array('name, so_name, e_mail', 'length', 'max' => 30),
	    array('phone', 'length', 'max' => 15),
	    array('city', 'length', 'max' => 31),
	    array('photo', 'length', 'max' => 127),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, created, state, username, subj, password, role, name, so_name, e_mail, phone, organization, slogan, promotwext, confirm, url, city, photo, params', 'safe'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'created' => 'Created',
	    'state' => 'State',
	    'username' => 'Username',
	    'password' => 'Password',
	    'role' => 'Role',
	    'name' => 'Name',
	    'so_name' => 'So Name',
	    'otchestvo' => 'Otchestvo',
	    'e_mail' => 'E Mail',
	    'phone' => 'Phone',
	    'organization' => 'Organization',
	    'codeReg' => 'Code Reg',
	    'codeDate' => 'Code Date',
	    'city' => 'City',
	    'skype' => 'Skype',
	    'icq' => 'Icq',
	    'photo' => 'Photo',
	);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
	// @todo Please modify the following code to remove attributes that should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('id', $this->id, true);
	$criteria->compare('created', $this->created, true);
	$criteria->compare('state', $this->state);
	$criteria->compare('username', $this->username, true);
	$criteria->compare('password', $this->password, true);
	$criteria->compare('role', $this->role, true);
	$criteria->compare('name', $this->name, true);
	$criteria->compare('so_name', $this->so_name, true);
	$criteria->compare('otchestvo', $this->otchestvo, true);
	$criteria->compare('e_mail', $this->e_mail, true);
	$criteria->compare('phone', $this->phone, true);
	$criteria->compare('organization', $this->organization, true);
	$criteria->compare('info_moder', $this->info_moder);
	$criteria->compare('info_order', $this->info_order);
	$criteria->compare('info_deactivate', $this->info_deactivate);
	$criteria->compare('auto_notepad', $this->auto_notepad);
	$criteria->compare('info_flag_phone', $this->info_flag_phone);
	$criteria->compare('info_flag_email', $this->info_flag_email);
	$criteria->compare('info_phone', $this->info_phone, true);
	$criteria->compare('info_email', $this->info_email, true);
	$criteria->compare('codeReg', $this->codeReg, true);
	$criteria->compare('codeDate', $this->codeDate, true);
	$criteria->compare('city', $this->city, true);
	$criteria->compare('skype', $this->skype, true);
	$criteria->compare('icq', $this->icq, true);
	$criteria->compare('photo', $this->photo, true);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

}
