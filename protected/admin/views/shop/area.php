<div class="pageContent">
    <div class="panelBar" style="width: 400px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("shop/editArea") ?>" target="dialog" width="250" height="200"" maxable="false" mask="true" title="添加地区。"><span>添加地区</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("shop/delArea"); ?>" target="selectedTodo" title="确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
            <li><a class="icon" href="<?php echo $this->createUrl("shop/index"); ?>" target="navTab" rel="shop-index"><span>商户管理</span></a></li>
        </ul>
    </div>
    <table class="list" width="400">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>地区名称</th>
            <th>上级地区</th>
            <th width="70">操作</th>
        </tr>
        <?php if (empty($areas)): ?>
        <tr>
            <td colspan="4">无数据</td>
        </tr>
        <?php else: foreach ($areas as $area): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $area->id ?>" /></td>
            <td><?php echo $area->name; ?></td>
            <td><?php if ($area->parent_id > 0) echo $area->Parent->name; else echo '无';?></td>
            <td>
                <a href="<?php echo $this->createUrl('shop/delArea', array('id'=>$area->id)); ?>" target="ajaxTodo" title="请确定删除？">删除</a>&nbsp;&nbsp;&nbsp;
                <a href="<?php echo $this->createUrl('shop/editArea', array('id'=>$area->id)); ?>" target="dialog" width="250" height="200" maxable="false" mask="true" title="修改地区">修改</a>
            </td>
        </tr>
        <?php endforeach; endif; ?>
    </table>
    <?php $this->widget('widget.Pager', array(
        'pages'=>$pages,
        'style'=>'width: 400px',
    )); ?>
</div>