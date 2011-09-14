<?php

/**
 * This is the model class for table "fanwe_user".
 *
 * The followings are the available columns in table 'fanwe_user':
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
 * @property integer $first_down
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
		return 'fanwe_user';
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
			array('status, create_time, update_time, sex, group_id, score, city_id, subscribe, parent_id, sync_flag, birthday, buy_count, is_receive_sms, ucenter_id, ucenter_id_tmp, first_buy, first_down', 'numerical', 'integerOnly'=>true),
			array('money', 'numerical'),
			array('user_name, user_pwd, nickname, last_ip, email, qq, msn, alim, address, fix_phone, fax_phone, mobile_phone, zip, pwd_question, pwd_answer', 'length', 'max'=>255),
			array('active_sn, reset_sn', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_name, user_pwd, nickname, status, create_time, update_time, last_ip, sex, email, qq, msn, alim, address, group_id, fix_phone, fax_phone, mobile_phone, zip, pwd_question, pwd_answer, score, money, city_id, subscribe, active_sn, reset_sn, parent_id, sync_flag, birthday, buy_count, is_receive_sms, ucenter_id, ucenter_id_tmp, first_buy, first_down', 'safe', 'on'=>'search'),
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
			'first_down' => 'First Down',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_pwd',$this->user_pwd,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('last_ip',$this->last_ip,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('msn',$this->msn,true);
		$criteria->compare('alim',$this->alim,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('fix_phone',$this->fix_phone,true);
		$criteria->compare('fax_phone',$this->fax_phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('pwd_question',$this->pwd_question,true);
		$criteria->compare('pwd_answer',$this->pwd_answer,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('money',$this->money);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('subscribe',$this->subscribe);
		$criteria->compare('active_sn',$this->active_sn,true);
		$criteria->compare('reset_sn',$this->reset_sn,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('sync_flag',$this->sync_flag);
		$criteria->compare('birthday',$this->birthday);
		$criteria->compare('buy_count',$this->buy_count);
		$criteria->compare('is_receive_sms',$this->is_receive_sms);
		$criteria->compare('ucenter_id',$this->ucenter_id);
		$criteria->compare('ucenter_id_tmp',$this->ucenter_id_tmp);
		$criteria->compare('first_buy',$this->first_buy);
		$criteria->compare('first_down',$this->first_down);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}