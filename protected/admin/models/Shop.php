<?php

/**
 * This is the model class for table "{{shop}}".
 *
 * The followings are the available columns in table '{{shop}}':
 * @property string $id
 * @property string $user_id
 * @property string $category_id
 * @property string $cover_img
 * @property string $area_id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $map
 * @property integer $support_cart
 * @property integer $has_parking
 * @property string $discount
 * @property string $capita
 * @property string $description
 * @property string $click_count
 * @property integer $sort
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class Shop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Shop the static model class
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
		return '{{shop}}';
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
			array('support_cart, has_parking, sort, status', 'numerical', 'integerOnly'=>true),
			array('user_id, category_id, cover_img, area_id, capita, click_count, create_time, update_time', 'length', 'max'=>10),
			array('name, map', 'length', 'max'=>50),
			array('phone', 'length', 'max'=>30),
			array('address', 'length', 'max'=>100),
			array('discount', 'length', 'max'=>500),
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
		    'Admin'=>array(self::BELONGS_TO, 'Admin', 'user_id', 'select'=>'Admin.name'),
		    'Category'=>array(self::BELONGS_TO, 'ShopCategory', 'category_id', 'select'=>'Category.name, Category.parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'category_id' => 'Category',
			'cover_img' => 'Cover Img',
			'area_id' => 'Area',
			'name' => 'Name',
			'phone' => 'Phone',
			'address' => 'Address',
			'map' => 'Map',
			'support_cart' => 'Support Cart',
			'has_parking' => 'Has Parking',
			'discount' => 'Discount',
			'capita' => 'Capita',
			'description' => 'Description',
			'click_count' => 'Click Count',
			'sort' => 'Sort',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		);
	}
}