<div class="pageContent">
    <div class="panelBar" style="width: 700px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("ad/edit") ?>" target="dialog" width="450" height="420" maxable="false" mask="true"><span>添加广告</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("ad/del"); ?>" target="selectedTodo" title="确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
        </ul>
    </div>
    <table class="list" width="700">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>广告标题</th>
            <th width="150">广告类型</th>
            <th width="30">排序</th>
            <th width="60">状态</th>
            <th width="120">操作</th>
        </tr>
        <?php if ($ads !== null) foreach ($ads as $ad): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $ad->id; ?>" /></td>
            <td><?php echo $ad->title; ?></td>
            <td><?php echo $types[$ad->type]['name']; ?></td>
            <td>
                    <span id="<?php echo $ad->id ?>" name="sort" title="点击即可修改排序" url="<?php $this->createUrl("ad/changeSort"); ?>" class="changeBtn"><?php echo $ad->sort; ?></span>
            </td>
            <td>
                <?php if ($ad->status): ?>
                启用
                <a href="<?php echo $this->createUrl('toogleStatus', array('id'=>$ad->id, 'status'=>false)) ?>" target="ajaxTodo">禁用</a>
                <?php else: ?>
                <a href="<?php echo $this->createUrl('toogleStatus', array('id'=>$ad->id, 'status'=>true)) ?>" target="ajaxTodo">启用</a>
                禁用
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('del', array('id'=>$ad->id)) ?>" target="ajaxTodo">删除</a>
                <a href="<?php echo $this->createUrl('edit', array('id'=>$ad->id)) ?>" target="dialog" width="450" height="420" maxable="false" mask="true">修改</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>