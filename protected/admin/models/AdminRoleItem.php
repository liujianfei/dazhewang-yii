<?php

/**
 * This is the model class for table "{{admin_role_item}}".
 *
 * The followings are the available columns in table '{{admin_role_item}}':
 * @property string $id
 * @property string $role_id
 * @property string $name
 * @property string $parent_id
 * @property string $description
 */
class AdminRoleItem extends CActiveRecord
{
    public $duration;
    public $dependency;


	/**
	 * Returns the static model of the specified AR class.
	 * @return AdminRoleItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function init()
	{
	    $this->duration = 3600 * 24 * 7;
	    $this->dependency = new CDbCacheDependency('SELECT COUNT( * ), MAX( update_time ) FROM '.$this->tableName());
	}

	public function cache()
	{
	    return parent::cache($this->duration, $this->dependency);
	}

	public function getIsAssign()
	{
	    return AdminRoleChild::model()->cache()->count('item_id = '.$this->id) > 0;
	}

	public function getIsInherit()
	{
        return AdminRoleChild::model()->cache()->count('item_id = '.$this->parent_id) > 0;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{admin_role_item}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, update_time', 'length', 'max'=>10),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			array('update_time', 'default', 'value'=>0),
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
		    'Role'=>array(self::MANY_MANY, 'AdminRole', '{{admin_role_child}}(item_id, role_id)'),
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
			'name' => 'Name',
			'parent_id' => 'Parent',
			'description' => 'Description',
		);
	}
}