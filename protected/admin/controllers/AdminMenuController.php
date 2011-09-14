<?php
class AdminMenuController extends Controller
{
    public function actionIndex($name = '', $status = null, $numPerPage = null, $pageNum = null)
    {
        $menus = AdminMenu::model();
        $criteria = $menus->dbCriteria;
	    if (!empty($status))
            $criteria->addCondition('t.status = '.(int)$status);
        if (!empty($name))
            $criteria->addCondition("t.name like '%{$name}%'");
        $criteria->order = "t.parent_id, t.sort";

        $count = $menus->count();
        $pages = new CPagination($count);
        $pages->currentPage = empty($pageNum) ? 0 : $pageNum - 1;
        $pages->pageSize = empty($numPerPage) ? 20 : $numPerPage;
        $pages->applyLimit($criteria);

        $menus = $menus->cache()->findAll($criteria);
        $this->render('index', array('menus'=>$menus, 'pages'=>$pages, 'name'=>$name));
    }

    /**
     * 添加/修改菜单
     */
    public function actionEdit($id = null)
    {
        $menu = new AdminMenu;

        if (isset($_POST['Form']))
        {
            if (!empty($_POST['Form']['id']))
            {
                $menu = $menu->findByPk($_POST['Form']['id']);
                $message = '修改成功';
            }
            else
                $message = '添加成功';

            $menu->attributes = $_POST['Form'];
            $menu->url_params = @serialize($menu->url_params);
            if ($menu->parent_id == 0) $menu->level = 1;
            else $menu->level = 2;

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

        if ($id !== null)
        {
            $criteria = new CDbCriteria;
    	    $criteria->condition = "id <> {$id} AND level < 3 AND parent_id = 0 AND status = 1";
            $parents = AdminMenu::model()->cache()->findAll($criteria);
            $menu = $menu->cache()->findByPk($id);
        }
        else
        {
            $criteria = new CDbCriteria;
    	    $criteria->condition = "id <> 0 AND level < 3 AND parent_id = 0 AND status = 1";
            $parents = AdminMenu::model()->cache()->findAll($criteria);
        }

        $this->render('edit', array('menu'=>$menu, 'parents'=>$parents));
    }

    /**
     * 删除菜单
     */
    public function actionDel(array $id = array())
    {
        if (empty($id))
            $this->error('参数传递错误');

        if (count($id) > 1)
        {
            $id = implode(',', $id);
            if (AdminMenu::model()->deleteAll('id in ('.$id.')') > 0)
                $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'menu-index');
            else
                $result = array('statusCode'=>300, 'message'=>'错误！');
        }
        else
        {
            $id = $id[0];
            if (AdminMenu::model()->deleteByPk($id) > 0)
                $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'menu-index');
            else
                $result = array('statusCode'=>300, 'message'=>'错误！');
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 切换菜单状态
     */
    public function actionToggleStatus($id = null, $status = false)
    {
        if ($id === null)
            $this->error('参数传递错误');

        $menu = AdminMenu::model()->findByPk($id);
        $menu->status = (int)$status;
        $menu->update_time = Yii::app()->params['timestamp'];
        if ($menu->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'menu-index');
        else
       {
            $error = array_shift($menu->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 更改排序
     */
    public function actionChangeSort($id = null, $sort = null)
    {
        if ($id === null || $sort === null)
            $this->error('参数传递错误');

        $menu = AdminMenu::model()->findByPk($id);
        $menu->sort = (int)$sort;
        $menu->update_time = Yii::app()->params['timestamp'];
        if ($menu->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'menu-index');
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