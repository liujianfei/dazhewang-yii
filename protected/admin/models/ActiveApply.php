<?php

/**
 * This is the model class for table "{{active_apply}}".
 *
 * The followings are the available columns in table '{{active_apply}}':
 * @property integer $id
 * @property string $uid
 * @property string $aid
 * @property string $create_time
 * @property string $status
 */
class ActiveApply extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ActiveApply the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function cache()
	{
	    $duration = 3600 * 24 * 7;
	    $dependency = new CDbCacheDependency('SELECT COUNT(*), MAX(update_time) FROM '.$this->tableName());
	    return parent::cache($duration, $dependency);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{active_apply}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, active_id, create_time, update_timess, status', 'length', 'max'=>10),
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
		    'User'=>array(self::BELONGS_TO, 'User', 'user_id', 'select'=>'user_name, mobile_phone'),
		    'Active'=>array(self::BELONGS_TO, 'Active', 'active_id', 'select'=>'name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'aid' => 'Aid',
			'create_time' => 'Create Time',
			'status' => 'Status',
		);
	}
}