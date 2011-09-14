<?php

/**
 * This is the model class for table "{{shop_image}}".
 *
 * The followings are the available columns in table '{{shop_image}}':
 * @property string $id
 * @property string $src
 * @property string $shop_id
 * @property integer $sort
 */
class ShopPicture extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ShopImage the static model class
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
		return '{{shop_picture}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort', 'required'),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('src', 'length', 'max'=>200),
			array('src', 'FileValidator', 'types'=>'jpg, png, gif', 'wrongType'=>'只允许上传图片',
				'maxSize'=>300 * 1024, 'tooLarge'=>'文件不能大于300K', 'message'=>'封面图片不能为空'),
			array('shop_id, create_time, update_time', 'length', 'max'=>10),
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
			'src' => 'Src',
			'shop_id' => 'Shop',
			'sort' => 'Sort',
		    'create_time'=>'Create Time',
		    'update_time'=>'Update Time'
		);
	}
}