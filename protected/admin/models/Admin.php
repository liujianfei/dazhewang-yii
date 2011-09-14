<?php

/**
 * This is the model class for table "{{admin}}".
 *
 * The followings are the available columns in table '{{admin}}':
 * @property string $id
 * @property string $name
 * @property string $password
 * @property string $role_id
 * @property string $city_id
 * @property string $login_time
 * @property string $last_ip
 * @property string $login_count
 * @property integer $is_supper
 * @property integer $status
 */
class Admin extends CActiveRecord
{
    public $duration;
    public $dependency;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function init()
	{
        $this->duration = 3600 * 24 * 7;
        $this->dependency = new CDbCacheDependency("SELECT COUNT( * ), MAX( update_time ) FROM {{admin}}");
	}

	public function cache()
	{
        return parent::cache($this->duration, $this->dependency);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{admin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, city_id, login_time, login_count, update_time, is_supper, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('password', 'length', 'max'=>32),
			array('id, role_id, city_id, login_time, login_count, update_time', 'length', 'max'=>10),
			array('login_time, login_count, is_supper, update_time', 'default', 'value'=>0),
			array('status', 'default', 'value'=>1),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		    'Role'=>array(self::BELONGS_TO, 'AdminRole', 'role_id', 'select'=>'name' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'password' => 'Password',
			'role_id' => 'Role',
			'city_id' => 'City',
			'login_time' => 'Login Time',
			'last_ip' => 'Last Ip',
			'login_count' => 'Login Count',
			'is_supper' => 'Is Supper',
			'status' => 'Status',
		);
	}
}