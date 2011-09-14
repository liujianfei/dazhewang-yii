<?php

/**
 * This is the model class for table "{{ad}}".
 *
 * The followings are the available columns in table '{{ad}}':
 * @property string $id
 * @property string $title
 * @property string $type
 * @property string $param
 * @property integer $status
 */
class Ad extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return Ad the static model class
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
		return '{{ad}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_time, end_time, update_time, sort, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('type, update_time, start_time, end_time', 'length', 'max'=>10),
			array('sort', 'length', 'max'=>3),
			array('sort', 'default', 'value'=>99),
			array('status', 'default', 'value'=>1),
			array('param', 'FileValidator', 'types'=>'jpg, png, gif', 'wrongType'=>'只允许上传图片',
				'maxSize'=>300 * 1024, 'tooLarge'=>'文件不能大于300K', 'message'=>'封面图片不能为空'),
			array('param', 'safe'),
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
			'title' => 'Title',
			'type' => 'Type',
			'param' => 'Param',
			'status' => 'Status',
		);
	}
}