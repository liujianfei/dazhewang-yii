<?php
class MenuController extends Controller
{
    public function actionIndex()
    {
        $menus = Menu::model()->cache()->findAll();
        $this->render("index", array('menus'=>$menus));
    }

    public function actionEdit($id = null)
    {
        $menu = new Menu;
        if ($id !== null)
            $menu = $menu->cache()->findByPk($id);

        if (isset($_POST['Form']))
        {
            if (!empty($_POST['Form']['id']))
            {
                $menu = $menu->cache()->findByPk($_POST['Form']['id']);
                $message = '修改成功';
            }
            else
                $message = '添加成功';

            $menu->attributes = $_POST['Form'];
            $menu->update_time = Yii::app()->params['timestamp'];

            if ($menu->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'menu-index');
            else
            {
                $error = array_shift($menu->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }

            echo json_encode($result);
            Yii::app()->end();
        }

        $this->render('edit', array('menu'=>$menu));
    }

    public function actionDel(array $id = array())
    {
        if (empty($id))
            $this->error('参数提交错误');
        if (count($id) > 1)
            $this->error('暂不支持批量删除');
        else
            $id = $id[0];
        $menu = Menu::model();
        $count = $menu->deleteByPk($id);
        if ($count > 0)
            $result = array('statusCode'=>200, 'message'=>"删除成功", 'navTabId'=>'menu-index');
        else
        {
            $error = array_shift($menu->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionToggleStatus($id = null, $status = null)
    {
        if ($id === null || $status === null)
            $this->error('参数提交错误');

        $menu = Menu::model()->cache()->findByPk($id);
        $menu->status = (int)$status;

        if ($menu->save())
            $result = array('statusCode'=>200, 'message'=>"修改成功", 'navTabId'=>'menu-index');
        else
        {
            $error = array_shift($menu->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionChangeSort($id = null, $sort = null)
    {
        if ($id === null || $sort === null)
            $this->error('参数提交错误');

        $menu = Menu::model()->cache()->findByPk($id);
        $menu->sort = (int)$sort;
        if ($menu->save())
            $result = array('statusCode'=>200, 'message'=>"修改成功", 'navTabId'=>'menu-index');
        else
        {
            $error = array_shift($menu->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }
}
?>