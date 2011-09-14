<div class="pageContent">
    <div class="panelBar" style="width: 800px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("active/edit") ?>" target="dialog" width="700" height="600" mask="true" title="添加活动。"><span>添加活动</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("active/del"); ?>" target="selectedTodo" title="确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
        </ul>
    </div>
    <table class="list" width="800">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>活动名</th>
            <th width="100">活动类型</th>
            <th width="100">开始报名时间</th>
            <th width="100">结束报名时间</th>
            <th width="100">活动时间</th>
            <th width="30">排序</th>
            <th width="60">状态</th>
            <th width="60">操作</th>
        </tr>
        <?php if ($actives !== null) foreach ($actives as $active): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $active->id ?>" /></td>
            <td><?php echo $active->title; ?></td>
            <td><?php echo $active->Category->name; ?></td>
            <td><?php echo date('Y-m-d H:i', $active->begin_time); ?></td>
            <td><?php echo date('Y-m-d H:i', $active->end_time); ?></td>
            <td><?php echo $active->start_time; ?></td>
            <td>
                <span id="<?php echo $active->id ?>" name="sort" title="点击即可修改排序" url="<?php echo $this->createUrl('active/changeSort'); ?>" class="changeBtn"><?php echo $active->sort; ?></span>
            </td>
            <td>
                <?php if ($active->status): ?>
                显示
                 <a href="<?php echo $this->createUrl('active/toggleStatus', array('id'=>$active->id, 'status'=>false)); ?>" target="ajaxTodo">隐藏</a>
                <?php else: ?>
                隐藏
                <a href="<?php echo $this->createUrl('active/toggleStatus', array('id'=>$active->id, 'status'=>true)); ?>" target="ajaxTodo">显示</a>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('active/del', array('id'=>$active->id)); ?>" target="ajaxTodo" title="确定删除？">删除</a>
                <a href="<?php echo $this->createUrl('active/edit', array('id'=>$active->id)); ?>" target="dialog" width="700" height="600" mask="true" title="修改活动">修改</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>