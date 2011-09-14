<?php

/**
 * This is the model class for table "tuangou_user".
 *
 * The followings are the available columns in table 'tuangou_user':
 * @property integer $id
 * @property string $user_name
 * @property string $user_pwd
 * @property string $nickname
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property string $last_ip
 * @property integer $sex
 * @property string $email
 * @property string $qq
 * @property string $msn
 * @property string $alim
 * @property string $address
 * @property integer $group_id
 * @property string $fix_phone
 * @property string $fax_phone
 * @property string $mobile_phone
 * @property string $zip
 * @property string $pwd_question
 * @property string $pwd_answer
 * @property integer $score
 * @property double $money
 * @property integer $city_id
 * @property integer $subscribe
 * @property string $active_sn
 * @property string $reset_sn
 * @property integer $parent_id
 * @property integer $sync_flag
 * @property integer $birthday
 * @property integer $buy_count
 * @property integer $is_receive_sms
 * @property integer $ucenter_id
 * @property integer $ucenter_id_tmp
 * @property integer $first_buy
 * @property integer $down_count
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'tuangou_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, create_time, update_time, sex, group_id, score, city_id, parent_id', 'required'),
			array('status, create_time, update_time, sex, group_id, score, city_id, subscribe, parent_id, sync_flag, birthday, buy_count, is_receive_sms, ucenter_id, ucenter_id_tmp, first_buy, down_count', 'numerical', 'integerOnly'=>true),
			array('money', 'numerical'),
			array('user_name, user_pwd, nickname, last_ip, email, qq, msn, alim, address, fix_phone, fax_phone, mobile_phone, zip, pwd_question, pwd_answer', 'length', 'max'=>255),
			array('active_sn, reset_sn', 'length', 'max'=>200),
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
			'user_name' => 'User Name',
			'user_pwd' => 'User Pwd',
			'nickname' => 'Nickname',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'last_ip' => 'Last Ip',
			'sex' => 'Sex',
			'email' => 'Email',
			'qq' => 'Qq',
			'msn' => 'Msn',
			'alim' => 'Alim',
			'address' => 'Address',
			'group_id' => 'Group',
			'fix_phone' => 'Fix Phone',
			'fax_phone' => 'Fax Phone',
			'mobile_phone' => 'Mobile Phone',
			'zip' => 'Zip',
			'pwd_question' => 'Pwd Question',
			'pwd_answer' => 'Pwd Answer',
			'score' => 'Score',
			'money' => 'Money',
			'city_id' => 'City',
			'subscribe' => 'Subscribe',
			'active_sn' => 'Active Sn',
			'reset_sn' => 'Reset Sn',
			'parent_id' => 'Parent',
			'sync_flag' => 'Sync Flag',
			'birthday' => 'Birthday',
			'buy_count' => 'Buy Count',
			'is_receive_sms' => 'Is Receive Sms',
			'ucenter_id' => 'Ucenter',
			'ucenter_id_tmp' => 'Ucenter Id Tmp',
			'first_buy' => 'First Buy',
			'down_count' => 'Down Count',
		);
	}
}