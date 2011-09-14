<?php
class HeadMenu extends CWidget
{
    public function run()
    {
        $menus = AdminMenu::model()->cache()->findAll("parent_id = 0");
        $this->render('HeadMenu/menu', array('menus'=>$menus));
    }
}
?>