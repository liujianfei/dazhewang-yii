<?php

/**
 * This is the model class for table "{{admin_menu}}".
 *
 * The followings are the available columns in table '{{admin_menu}}':
 * @property string $id
 * @property string $name
 * @property string $url_route
 * @property string $url_params
 * @property string $parent_id
 * @property string $level
 * @property integer $sort
 * @property string $update_time
 * @property integer $status
 */
class AdminMenu extends CActiveRecord
{
    public $duration;
    public $dependency;

	/**
	 * Returns the static model of the specified AR class.
	 * @return AdminMenu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function init()
	{
	    $this->duration = 3600 * 24 * 7;
	    $this->dependency = new CDbCacheDependency('SELECT COUNT(*), MAX(update_time) FROM {{admin_menu}}');
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
		return '{{admin_menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, level, update_time, sort, status', 'numerical', 'integerOnly'=>true),
			array('name, url_route', 'length', 'max'=>20),
			array('parent_id, level, update_time', 'length', 'max'=>10),
			array('sort', 'length', 'max'=>3),
			array('sort', 'default', 'value'=>99),
			array('url_params', 'safe'),
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
		    'Parent'=>array(self::BELONGS_TO, 'AdminMenu', 'parent_id', 'order'=>'Parent.sort'),
		    'Children'=>array(self::HAS_MANY, 'AdminMenu', 'parent_id', 'order'=>'Children.sort'),
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
			'url_route' => 'Url Route',
			'url_params' => 'Url Params',
			'parent_id' => 'Parent',
			'level' => 'Level',
			'sort' => 'Sort',
			'update_time' => 'Update Time',
			'status' => 'Status',
		);
	}
}