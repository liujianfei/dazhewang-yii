<?php

/**
 * This is the model class for table "{{active_category}}".
 *
 * The followings are the available columns in table '{{active_category}}':
 * @property string $id
 * @property string $name
 */
class ActiveCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ActiveCategory the static model class
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
		return '{{active_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>10),
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
		);
	}
}