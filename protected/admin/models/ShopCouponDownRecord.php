<?php

/**
 * This is the model class for table "{{shop_coupon_down_record}}".
 *
 * The followings are the available columns in table '{{shop_coupon_down_record}}':
 * @property string $coupon_id
 * @property string $user_id
 * @property string $down_time
 */
class ShopCouponDownRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ShopCouponDownRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{shop_coupon_down_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('coupon_id, user_id, down_time', 'length', 'max'=>10),
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
			'coupon_id' => 'Coupon',
			'user_id' => 'User',
			'down_time' => 'Down Time',
		);
	}
}