<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property string $id
 * @property string $name
 * @property string $url
 * @property string $sort
 * @property integer $status
 */
class Menu extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function cache()
	{
	    $duration = 3600 * 24 * 7;
	    $dependency = new CDbCacheDependency('SELECT COUNT( * ), MAX( update_time ) FROM '.$this->tableName());
	    return parent::cache($duration, $dependency);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'required'),
			array('sort, status', 'numerical', 'integerOnly'=>true),
			array('name, url', 'length', 'max'=>255),
			array('sort', 'length', 'max'=>3),
			array('sort', 'default', 'value'=>99),
			array('params', 'safe'),
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
			'url' => 'Url',
			'sort' => 'Sort',
			'status' => 'Status',
		);
	}
}