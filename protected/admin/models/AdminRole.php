<?php

/**
 * This is the model class for table "{{admin_role}}".
 *
 * The followings are the available columns in table '{{admin_role}}':
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property string $description
 */
class AdminRole extends CActiveRecord
{
    public $duration;
    public $dependency;

	/**
	 * Returns the static model of the specified AR class.
	 * @return AdminRole the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function init()
	{
	    $this->duration = 3600 * 24;
	    $this->dependency = new CDbCacheDependency('SELECT COUNT(*), MAX(update_time) FROM '.$this->tableName());
        // Import entity class
        YII::import("application.models.entity.auth.AuthRole");
	}

	public function cache()
	{
	    return parent::cache($this->duration, $this->dependency);
	}

	public function getAdminCount()
	{
        return Admin::model()->count("role_id = {$this->id}");
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{admin_role}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('name', 'required', 'message'=>'权限组名不能为空'),
			array('update_time, status', 'numerical', 'integerOnly'=>true, 'message'=>'状态仅允许数字类型'),
			array('id, update_time', 'length', 'max'=>10),
			array('name', 'length', 'max'=>20, 'message'=>'权限组名过长'),
			array('update_time', 'default', 'value'=>0),
			array('name', 'unique', 'on'=>'insert', 'message'=>'权限组名重复'),
			array('description', 'safe'),
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
		    'Items'=>array(self::MANY_MANY, 'AdminRoleItem', '{{admin_role_child}}(role_id, item_id)'),
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
			'status' => 'Status',
			'description' => 'Description',
		);
	}

}