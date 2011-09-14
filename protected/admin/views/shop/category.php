<div class="pageContent">
    <div class="panelBar" style="width: 600px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("shop/editCategory") ?>" target="dialog" width="250" height="200"" maxable="false" mask="true" title="添加分类。"><span>添加分类</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("shop/delCategory"); ?>" target="selectedTodo" title="确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
            <li><a class="icon" href="<?php echo $this->createUrl("shop/index"); ?>" target="navTab" rel="shop-index"><span>商户管理</span></a></li>
        </ul>
    </div>
    <table class="list" width="600">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>分类名</th>
            <th>主分类</th>
            <th width="70">状态</th>
            <th width="140">操作</th>
        </tr>
        <?php if (empty($categories)): ?>
        <tr>
            <td colspan="5">无数据</td>
        </tr>
        <?php else: foreach ($categories as $category): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $category->id ?>" /></td>
            <td><?php echo $category->name; ?></td>
            <td><?php if ($category->parent_id > 0) echo $category->Parent->name; else echo '无';?></td>
            <td>
                <?php if ($category->status): ?>
                启用&nbsp;&nbsp;&nbsp;
                 <a href="<?php echo $this->createUrl('shop/toggleCategoryStatus', array('id'=>$category->id, 'status'=>false)); ?>" target="ajaxTodo">禁用</a>
                <?php else: ?>
                <a href="<?php echo $this->createUrl('shop/toggleCategoryStatus', array('id'=>$category->id, 'status'=>true)); ?>" target="ajaxTodo">启用</a>
                &nbsp;&nbsp;&nbsp;禁用
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('shop/delCategory', array('id'=>$category->id)); ?>" target="ajaxTodo" title="请确定删除？">删除</a>&nbsp;&nbsp;&nbsp;
                <a href="<?php echo $this->createUrl('shop/editCategory', array('id'=>$category->id)); ?>" target="dialog" width="250" height="200" maxable="false" mask="true" title="修改分类">修改</a>&nbsp;&nbsp;&nbsp;
                <a href="<?php echo $this->createUrl('shop/index', array('category'=>$category->id)); ?>" target="navTab" rel="shop-index">查看商户</a>
            </td>
        </tr>
        <?php endforeach; endif; ?>
    </table>
    <?php $this->widget('widget.Pager', array(
        'pages'=>$pages,
        'style'=>'width: 600px',
    )); ?>
</div>