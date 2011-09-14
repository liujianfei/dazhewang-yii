<?php

/**
 * This is the model class for table "{{active}}".
 *
 * The followings are the available columns in table '{{active}}':
 * @property string $id
 * @property string $title
 * @property string $category_id
 * @property string $cover_img_small
 * @property string $cover_img_big
 * @property string $address
 * @property string $point
 * @property string $begin_time
 * @property string $end_time
 * @property string $start_time
 * @property string $content
 * @property integer $sort
 * @property integer $status
 * @property string $update_time
 * @property integer $preview
 */
class Active extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Active the static model class
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
		return '{{active}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, status, preview', 'required'),
			array('sort, status, preview', 'numerical', 'integerOnly'=>true),
			array('title, start_time', 'length', 'max'=>20),
			array('category_id, begin_time, end_time, update_time', 'length', 'max'=>10),
			array('cover_img_small, cover_img_big', 'length', 'max'=>200),
			array('cover_img_small, cover_img_big', 'FileValidator', 'types'=>'jpg, png, gif',
				'wrongType'=>'只允许上传图片', 'maxSize'=>300 * 1024, 'tooLarge'=>'文件不能大于300K', 'message'=>'封面图片不能为空'),
			array('address', 'length', 'max'=>100),
			array('point', 'length', 'max'=>5),
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
		    'Category'=>array(self::BELONGS_TO, 'ActiveCategory', 'category_id'),
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
			'category_id' => 'Category',
			'cover_img_small' => 'Cover Img Small',
			'cover_img_big' => 'Cover Img Big',
			'address' => 'Address',
			'point' => 'Point',
			'begin_time' => 'Begin Time',
			'end_time' => 'End Time',
			'start_time' => 'Start Time',
			'content' => 'Content',
			'sort' => 'Sort',
			'status' => 'Status',
			'update_time' => 'Update Time',
			'preview' => 'Preview',
		);
	}
}