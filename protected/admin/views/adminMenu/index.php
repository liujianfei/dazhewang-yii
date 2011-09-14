<?php $this->widget('widget.Search', array(
    'panleStyle'=>'width: 690px;',
    'searchCondition'=>array(
    	'菜单名：'=>array('type'=>'text', 'name'=>'name', 'defaultValue'=>$name, 'alt'=>'支持模糊搜索'),
    ),
)); ?>
<div class="pageContent">
    <div class="panelBar" style="width: 700px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("adminMenu/edit") ?>" target="dialog" width="280" height="290"" resizable="false" maxable="false" mask="true" title="添加菜单。"><span>添加菜单</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("adminMenu/del"); ?>" target="selectedTodo" title="确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
        </ul>
    </div>
    <table class="list" width="700">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>菜单名</th>
            <th>父菜单</th>
            <th width="30">排序</th>
            <th width="100">状态</th>
            <th width="120">操作</th>
        </tr>
        <?php if ($menus !== null) foreach ($menus as $menu): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $menu->id ?>" /></td>
            <td><?php echo $menu->name; ?></td>
            <td><?php if ($menu->level == 1) echo '无'; else echo $menu->Parent->name; ?></td>
            <td>
                <span id="<?php echo $menu->id ?>" name="sort" title="点击即可修改排序" url="<?php echo $this->createUrl('adminMenu/changeSort'); ?>" class="changeBtn"><?php echo $menu->sort; ?></span>
            </td>
            <td>
                <?php if (!empty($menu->Parent->name) && !$menu->Parent->status): ?>
                 父菜单禁用&nbsp;&nbsp;&nbsp;
                 <a href="<?php echo $this->createUrl('adminMenu/toggleStatus', array('id'=>$menu->Parent->id, 'status'=>true)); ?>" target="ajaxTodo">启用</a>
                <?php elseif ($menu->status): ?>
                启用&nbsp;&nbsp;&nbsp;
                 <a href="<?php echo $this->createUrl('adminMenu/toggleStatus', array('id'=>$menu->id, 'status'=>false)); ?>" target="ajaxTodo">禁用</a>
                <?php else: ?>
                禁用&nbsp;&nbsp;&nbsp;
                <a href="<?php echo $this->createUrl('adminMenu/toggleStatus', array('id'=>$menu->id, 'status'=>true)); ?>" target="ajaxTodo">启用</a>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('adminMenu/del', array('id'=>$menu->id)); ?>" target="ajaxTodo" title="其子项将会保留！请确定删除？">删除</a>
                <a href="<?php echo $this->createUrl('adminMenu/edit', array('id'=>$menu->id)); ?>" target="dialog" width="280" height="290" resizable="false" maxable="false" mask="true" title="修改菜单">修改</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php $this->widget('widget.Pager', array(
    	'pages'=>$pages,
    	'style'=>'width: 700px',
    )); ?>
</div>
