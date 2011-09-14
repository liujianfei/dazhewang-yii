<?php
class AuthController extends Controller
{

    /**
     * 管理员管理
     */
    public function actionAdmin($role_id = null, $numPerPage = null, $pageNum = null)
    {
        // 返回所有权限组
        $roles = AdminRole::model()->cache()->findAll();

        $model = Admin::model();
        $criteria = new CDbCriteria();

        if ( !empty($role_id))
            $criteria->addCondition("Role.id = {$role_id}");
        else
            $role_id = 0;
        //
        // 生成分页信息
        //
        $count = $model->count($criteria);

        $pages = new CPagination($count);
        $pages->currentPage = $pageNum !== null ? $pageNum - 1 : 0;
        $pages->pageSize = $numPerPage !== null ? $numPerPage : 10;
        $pages->applyLimit($criteria);

        $criteria->select = array('id', 'name', 'login_time', 'login_count', 'INET_NTOA(last_ip) as last_ip', 'role_id', 'city_id', 'is_supper', 'status');

        $list = $model->cache()->findAll($criteria);

        $this->render("admin", array( 'list'=>$list, 'roles'=>$roles, 'pages'=>$pages, 'role_id'=>$role_id ));
    }

	/**
     * 添加/修改管理员
     */
    public function actionEditAdmin($id = null)
    {
        $admin = new Admin;
        if ($id !== null)
            $admin = $admin->cache()->findByPk($id);

        if (isset($_POST['Form']))
        {
            if (!empty($_POST['Form']['id']))
            {
                $admin = $admin->cache()->findByPk($_POST['Form']['id']);
                $message = '修改成功';
            }
            else
                $message = '添加成功';

            if (!empty($_POST['Form']['id']) && trim($_POST['Form']['password']) == "")
                $_POST['Form']['password'] = $admin->password;
            else
                $_POST['Form']['password'] = md5(trim($_POST['Form']['password']));

            $admin->attributes = $_POST['Form'];
            $admin->update_time = Yii::app()->params['timestamp'];
            if ($admin->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'auth-admin');
            else
            {
                $error = array_shift($admin->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }

            echo json_encode($result);
            Yii::app()->end();
        }

        $roles = AdminRole::model()->cache()->findAll();
        $cities = array();

        $this->render('admin_edit', array('admin'=>$admin, 'roles'=>$roles, 'cities'=>$cities));
    }

	/**
     * 修改密码
     * @param string $oldPwd
     * @param string $newPwd
     */
    public function actionChangePwd($oldPwd = null, $newPwd = null)
    {
        if (isset($_POST['Form']))
        {
            $admin = Admin::model()->cache()->findByPk(Yii::app()->user->id);
            if ($admin->password === md5(trim($oldPwd)))
            {
                if (trim($oldPwd) === trim($newPwd))
                {
                    $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'menu-index');
                }
                $admin->password = md5(trim($newPwd));
                $admin->update_time = Yii::app()->params['timestamp'];

                if ($admin->save())
                {
                    $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'menu-index');
                }
                else
                {
                    $error = array_shift($admin->getErrors());
                    $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
                }
                echo json_encode($result);
                Yii::app()->end();
            }
            else
                $result = array('statusCode'=>300, 'message'=>'修改失败，旧密码错误！');
        }
        $this->render('admin_changePwd');
    }

    /**
     * 删除管理员
     */
    public function actionDelAdmin(array $id = array())
    {
        if ( $id === null)
            $this->error('参数传递错误');

        // 批量删除
        if (count($id) > 1)
        {
            // 组合成字符串
            $id = implode(',', $id);
            if (Admin::model()->deleteAll("id in ({$id})") > 0)
                $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'auth-admin');
            else
                $result = array('statusCode'=>300, 'message'=>'删除失败，请联系管理员');
        }
        else
        {
            $id = $id[0];
            if (Admin::model()->deleteByPk($id) > 0)
                $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'auth-admin');
            else
                $result = array('statusCode'=>300, 'message'=>'删除失败，请联系管理员');
        }
        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 权限组管理
     */
    public function actionRole()
    {
        $roles = AdminRole::model()->cache()->findAll();
        $this->render("role", array('roles'=>$roles));
    }

    /*
     * 修改权限组
     */
    public function actionEditRole($id = null)
    {
        $role = new AdminRole;

        if (isset($_POST['Form']))
        {
            if (!empty($_POST['Form']['id']))
            {
                $role = $role->cache()->findByPk($_POST['Form']['id']);
                $message = '修改成功';
            }
            else
                $message = '添加成功';

            $role->attributes = $_POST['Form'];
            $role->update_time = Yii::app()->params['timestamp'];

            if ($role->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'auth-role');
            else
            {
                $error = array_shift($role->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }

            echo json_encode($result);
            Yii::app()->end();
        }

        if ($id !== null)
            $role = $role->cache()->findByPk($id);

        $this->render("role_edit", array('role'=>$role));
    }

    /**
     * 删除权限组
     */
    public function actionDelRole(array $id = array())
    {
        if ( $id === null)
            $this->error('参数传递错误');

        // 批量删除
        if (count($id) > 1)
        {
            // 组合成字符串
            $id = implode(',', $id);
            // 删除其下属管理员
            Admin::model()->deleteAll("role_id in ({$id})");
            // 删除其下权限分配信息
            AdminRoleChild::model()->deleteAll("role_id in ({$id})");
            // 删除管理权限组
            if (AdminRole::model()->deleteAll("id in ({$id})") > 0)
                $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'auth-role');
            else
                $result = array('statusCode'=>300, 'message'=>'删除失败，请联系管理员');
        }
        else
        {
            $id = $id[0];
            // 删除其下属管理员
            Admin::model()->deleteAll("role_id = {$id}");
            // 删除其下权限分配信息
            AdminRoleChild::model()->deleteAll("role_id = {$id}");
            // 删除管理权限组
            if (AdminRole::model()->deleteByPk($id) > 0)
                $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'auth-role');
            else
                $result = array('statusCode'=>300, 'message'=>'删除失败，请联系管理员');
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 切换角色权限组状态
     */
    public function actionToggleStatus($id = null, $status = null)
    {
        if ( $id === null)
            $this->error('参数传递错误');

        if ( $status === null)
            $this->error('参数传递错误');

        $role = AdminRole::model()->findByPk($id);
        $role->status = $status;
        $role->update_time = Yii::app()->parames['timestamp'];

        if ($role->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'auth-role');
        else
        {
            $error = array_shift($role->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 配置权限组权限
     */
    public function actionItem($id = null, $numPerPage = null, $pageNum = null)
    {
        if ( $id === null)
            $this->error('参数传递错误');

        $role = AdminRole::model()->cache()->findByPk($id);
        $model = new AdminRoleItem;
        $criteria = new CDbCriteria();

        $count = $model->count();
        $pages = new CPagination($count);
        $pages->currentPage = $pageNum !== null ? $pageNum - 1 : 0;
        $pages->pageSize = $numPerPage !== null ? $numPerPage : 10;
        $pages->applyLimit($criteria);

        $allItems = $model->cache()->findAll($criteria);
        $this->render('item', array('role'=>$role, 'allItems'=>$allItems, 'pages'=>$pages));
    }

    /**
     * 编辑权限
     */
    public function actionEditItem($id = null)
    {
        $item = new AdminRoleItem;

        if (isset($_POST['Form']))
        {
            if (!empty($_POST['Form']['id']))
            {
                $item = $item->cache()->findByPk($_POST['Form']['id']);
                $message = '修改成功';
            }
            else
                $message = '添加成功';

            $item->attributes = $_POST['Form'];
            $item->update_time = Yii::app()->parames['timestamp'];

            if ($item->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'auth-role-config');
            else
            {
                $error = array_shift($item->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }

            echo json_encode($result);
            Yii::app()->end();
        }

        $allItems = $item->cache()->findAll('id <> '.$id);
        if ($id !== null)
            $item = $item->cache()->findByPk($id);

        $this->render('item_edit', array('allItems'=>$allItems, 'item'=>$item));
    }

    /**
     * 删除权限
     */
    public function actionDelItem(array $id = array())
    {
        if ( $id === null)
            $this->error('参数传递错误');
        if ( count($id) > 1 )
            $this->error('暂不支持批量删除');
        else
            $id = $id[0];
        // 连带删除子项
        AdminRoleItem::model()->deleteAll("parent_id = {$id}");

        if (AdminRoleItem::model()->deleteByPk($id) > 0)
            $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'auth-role-config');
        else
            $result = array('statusCode'=>300, 'message'=>'错误！');

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 授权
     */
    public function actionAssign($id = null, $roleId = null)
    {
        if ( $id === null)
            $this->error('参数传递错误');

        if ( $roleId === null)
            $this->error('参数传递错误');


        // 检查其下权限是否有被授权过
        $items = AdminRoleChild::model()->findAllByAttributes(array('role_id'=>$roleId));
        foreach ($items as $item)
        {
            // 如果有，则撤销授权
            if ($item->item_id == $id)
                AdminRoleChild::model()->deleteAllByAttributes(array('item_id'=>$item->id));
        }

        $model = new AdminRoleChild;
        $model->role_id = $roleId;
        $model->item_id = $id;

        if ($model->save())
            $result = array('statusCode'=>200, 'message'=>'授权成功', 'navTabId'=>'auth-role-config');
        else
        {
            $error = array_shift($model->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 撤销授权
     */
    public function actionRevoke($id = null, $roleId = null)
    {
        if ( $id === null)
            $this->error('参数传递错误');

        if ( $roleId === null)
            $this->error('参数传递错误');

        if (AdminRoleChild::model()->deleteAllByAttributes(array('item_id'=>$id, 'role_id'=>$roleId)) > 0)
            $result = array('statusCode'=>200, 'message'=>'撤销授权成功', 'navTabId'=>'auth-role-config');
        else
            $result = array('statusCode'=>300, 'message'=>'撤销授权失败');

        echo json_encode($result);
        Yii::app()->end();
    }
}
?>