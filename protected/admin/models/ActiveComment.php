<?php

/**
 * This is the model class for table "{{active_comment}}".
 *
 * The followings are the available columns in table '{{active_comment}}':
 * @property string $id
 * @property string $content
 * @property string $create_time
 * @property string $user_id
 * @property string $active_id
 */
class ActiveComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ActiveComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function cache()
	{
	    $duration = 3600 * 24 * 7;
	    $dependency = new CDbCacheDependency('SELECT COUNT(*) FROM '.$this->tableName());
	    return parent::cache($duration, $dependency);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{active_comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time, user_id', 'length', 'max'=>10),
			array('active_id', 'length', 'max'=>11),
			array('content', 'safe'),
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
		    'Active'=>array(self::BELONGS_TO, 'Active', 'active_id'),
		    'User'=>array(self::BELONGS_TO, 'User', 'user_id', 'select'=>'user_name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Content',
			'create_time' => 'Create Time',
			'user_id' => 'User',
			'active_id' => 'Active',
		);
	}
}