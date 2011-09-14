<?php

/**
 * This is the model class for table "{{admin_role_child}}".
 *
 * The followings are the available columns in table '{{admin_role_child}}':
 * @property string $id
 * @property string $role_id
 * @property string $item_id
 */
class AdminRoleChild extends CActiveRecord
{
    public $duration;
    public $dependency;

	/**
	 * Returns the static model of the specified AR class.
	 * @return AdminRoleChild the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function init()
	{
	    $this->duration = 3600 * 24 * 7;
	    $this->dependency = new CDbCacheDependency('SELECT COUNT( * ) FROM '.$this->tableName());
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
		return '{{admin_role_child}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, item_id', 'length', 'max'=>10),
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
			'role_id' => 'Role',
			'item_id' => 'Item',
		);
	}
}