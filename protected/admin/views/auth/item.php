<div class="pageHeader" style="width: 690px">
    <strong>权限配置 - <?php echo $role->name; ?></strong>
</div>
<div class="pageContent">
    <div class="panelBar" style="width: 700px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("auth/editItem") ?>" target="dialog" width="350" height="250" resizable="false" maxable="false" mask="true" title="添加权限。"><span>添加权限</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("auth/delItem"); ?>" target="selectedTodo" title="确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
        </ul>
    </div>
    <table class="list" width="700">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th width="150">授权模块名</th>
            <th>描述</th>
            <th width="120">状态</th>
            <th width="150">操作</th>
        </tr>
        <?php if ($allItems !== null) foreach ($allItems as $item): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $item->id; ?>" /></td>
            <td><?php echo $item->name; ?></td>
            <td><?php echo $item->description; ?></td>
            <td>
                <?php if ($item->isAssign): ?>
                已授权&nbsp;&nbsp;&nbsp;
                <a href="<?php echo $this->createUrl('auth/revoke', array('id'=>$item->id, 'roleId'=>$role->id)) ; ?>" target="ajaxTodo">撤销授权</a>
                <?php elseif ($item->isInherit): echo '继承';
                else: ?>
                未授权&nbsp;&nbsp;&nbsp;
                <a href="<?php echo $this->createUrl('auth/assign', array('id'=>$item->id, 'roleId'=>$role->id)) ; ?>" target="ajaxTodo">授权</a>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('auth/editItem', array('id'=>$item->id)); ?>" target="dialog" width="350" height="250" resizable="false" maxable="false" mask="true" title="修改权限-请确定该模块已经改名。">修改权限</a>
                <a href="<?php echo $this->createUrl('auth/delItem', array('id'=>$item->id)) ?>" target="ajaxTodo" title="请确定该模块已经废弃或者删除。是否删除？">删除</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php $this->widget('widget.Pager', array(
        'pages'=>$pages,
        'style'=>'width: 700px',
    )); ?>
</div>
