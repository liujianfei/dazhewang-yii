<?php
class HeadNav extends CWidget
{
    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'status = 1';
        $criteria->order = 'sort';
        $menus = Menu::model()->cache()->findAll($criteria);
        $this->render('HeadNav/index', array('menus'=>$menus));
    }
}
?>