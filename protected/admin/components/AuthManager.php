<?php
/**
 *
 * 授权模块
 * @author Yuanchensi
 *
 */
class AuthManager extends CApplicationComponent
{
	/**
     * @param array $itemName 需要验证权限的controller id and action id
     * @param mixed $userId 需要验证权限的user id
     * @param array $params 验证权限附带的参数
     * @return boolean 验证结果
     */
    public function checkAccess($itemName, $userId, $params=array ( ))
    {
        $criteria = new CDbCriteria(array('select'=>'is_supper', 'condition'=>'id = :userId', 'params'=>array(':userId'=>$userId)));
        $user = Admin::model()->find($criteria);
        if ($user->is_supper == 1) return true;
        // 获取controller and action
        $itemName = explode('/', strtolower($itemName));
        $controller = $itemName[0];
        $action = $itemName[1];
        // 获取会员角色组
        $role = AdminRole::model()->getByUser($userId);
        //Dumper::dump($role->items);Yii::app()->end();
        if ($role !== null) foreach ($role->items as $item)
        {
            // 获取会员角色组权限
            $item = explode('/', strtolower($item->name));
            // 如果拥有当前控制器权限
            if ($item[0] === $controller)
            {
                // 如果拥有所有权限
                if ($item[1] === '*') return true;
                // 如果拥有指定权限
                else if ($item[1] === $action) return true;
            }
        }
        return false;
    }
}
?>