<?php

/**
 * This is the model class for table "{{shop_coupon}}".
 *
 * The followings are the available columns in table '{{shop_coupon}}':
 * @property string $id
 * @property string $name
 * @property string $shop_id
 * @property string $cover_img
 * @property string $content
 * @property string $begin_time
 * @property string $end_time
 * @property string $down_count
 * @property string $mms_id
 * @property string $create_time
 * @property string $update_time
 */
class ShopCoupon extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ShopCoupon the static model class
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
		return '{{shop_coupon}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>30),
			array('shop_id, begin_time, end_time, down_count, mms_id, create_time, update_time', 'length', 'max'=>10),
			array('cover_img', 'length', 'max'=>200),
			array('cover_img', 'FileValidator', 'types'=>'jpg, png, gif', 'wrongType'=>'只允许上传图片',
				'maxSize'=>300 * 1024, 'tooLarge'=>'文件不能大于300K', 'message'=>'封面图片不能为空'),
			array('mms_id', 'default', 'value'=>''),
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
		    'Shop'=>array(self::BELONGS_TO, 'Shop', 'shop_id', 'select'=>'Shop.id, Shop.name, Shop.discount, Shop.status'),
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
			'shop_id' => 'Shop',
			'cover_img' => 'Cover Img',
			'content' => 'Content',
			'begin_time' => 'Begin Time',
			'end_time' => 'End Time',
			'down_count' => 'Down Count',
			'mms_id' => 'Mms',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		);
	}

}