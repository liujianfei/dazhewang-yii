<?php
	class MemberActive extends CWidget{
		public function run(){
			$categorys=array();
			$actives= Active::model()->findAll();
			foreach ($actives as $active)
			{
				$categorys[$active->id]=ActiveCategory::model()->findByAttributes(array('id'=>$active->category_id));
			}
			$this->render('MemberActive/Active',array(
				'actives'=>$actives,
				'categorys'=>$categorys,
			));
		}
	}