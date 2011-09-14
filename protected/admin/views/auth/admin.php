<?php
foreach($roles as $role)
    $options[$role->name] = $role->id;
$this->widget('widget.Search', array(
    'panleStyle'=>'width: 790px;',
    'searchCondition'=>array(
        '权限组：'=>array(
        	'type'=>'select',
        	'name'=>'role_id',
            'defaultValue'=>$role_id,
            'options'=>$options,
        ),
    ),
)); ?>
<div class="pageContent">
    <div class="panelBar" style="width: 800px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("auth/editAdmin") ?>" target="dialog" width="280" height="300" mask="true" title="添加管理员"><span>添加管理员</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("auth/delAdmin"); ?>" target="selectedTodo" title="确定删除选定管理员？" rel="id[]" ><span>删除选定</span></a></li>
            <li><a class="icon" href="<?php echo $this->createUrl("auth/role") ?>" target="navTab" rel="auth-role"><span>权限组列表</span></a></li>
        </ul>
    </div>
    <table class="list" width="800">
        <thead>
            <tr>
                <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
                <th width="100">管理员</th>
                <th width="100">权限组</th>
                <th>最后登录时间</th>
                <th width="80">登录次数</th>
                <th width="120">最后登录IP</th>
                <th width="80">超级管理员</th>
                <th width="30">状态</th>
                <th width="100">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($list !== null) foreach($list as $val) : ?>
            <tr>
                <td><input type="checkbox" name="id[]" value="<?php echo $val->id; ?>" /></td>
                <td><?php echo $val->name; ?></td>
                <td><?php echo isset($val->Role->name) ? $val->Role->name : '无'; ?></td>
                <td><?php echo date('Y-m-d H:i', $val->login_time); ?></td>
                <td><?php echo $val->login_count; ?></td>
                <td><?php echo $val->last_ip; ?></td>
                <td><?php echo $val->is_supper == 1 ? '是' : '否'; ?></td>
                <td><?php echo $val->status == 1 ? '启用' : '停用'; ?></td>
                <td>
                    <a href="<?php echo $this->createUrl("auth/editAdmin", array('id'=>$val['id'])); ?>" target="dialog" width="280" height="300" mask="true" title="修改管理员">修改</a>
                    <a href="<?php echo $this->createUrl("auth/delAdmin", array('id'=>$val['id'])); ?>" target="ajaxTodo" title="确定删除改管理员？">删除</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php $this->widget('widget.Pager', array(
    	'pages'=>$pages,
    	'style'=>'width: 800px;',
    )); ?>
</div>