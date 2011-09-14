<?php $this->widget('widget.Search', array(
    'panleStyle'=>'width: 790px;',
    'searchCondition'=>array(
    	'商户名：'=>array('type'=>'text', 'name'=>'name', 'defaultValue'=>$name, 'alt'=>'支持模糊搜索'),
    ),
)); ?>
<div class="pageContent">
    <div class="panelBar" style="width: 800px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("shop/edit") ?>" target="dialog" width="450" height="510"" maxable="false" title="添加商户。"><span>添加商户</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("shop/del"); ?>" target="selectedTodo" title="优惠券也会删除，确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
            <li><a class="icon" href="<?php echo $this->createUrl("shop/category"); ?>" target="navTab" rel="shop-category"><span>商户分类管理</span></a></li>
            <li><a class="icon" href="<?php echo $this->createUrl("shop/area"); ?>" target="navTab" rel="shop-area"><span>商户地区管理</span></a></li>
        </ul>
    </div>
    <table class="list" width="800">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>商户名</th>
            <th>上传人</th>
            <th>商户类别</th>
            <th width="40">点击量</th>
            <th width="30">排序</th>
            <th width="70">状态</th>
            <th width="180">操作</th>
        </tr>
        <?php if (empty($shops)): ?>
        <tr>
            <td colspan="8">无数据</td>
        </tr>
        <?php else: foreach ($shops as $shop): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $shop->id ?>" /></td>
            <td><?php echo $shop->name; ?></td>
            <td><?php echo $shop->Admin->name; ?></td>
            <td><?php echo $shop->Category->Parent->name.'-'.$shop->Category->name; ?></td>
            <td>
                <span id="<?php echo $shop->id ?>" name="count" title="点击即可修改点击量" url="<?php echo $this->createUrl('shop/changeClickCount'); ?>" class="changeBtn"><?php echo $shop->click_count; ?></span>
            </td>
            <td>
                <span id="<?php echo $shop->id ?>" name="sort" title="点击即可修改排序" url="<?php echo $this->createUrl('shop/changeSort'); ?>" class="changeBtn"><?php echo $shop->sort; ?></span>
            </td>
            <td>
                <?php if ($shop->status): ?>
                启用&nbsp;&nbsp;&nbsp;
                 <a href="<?php echo $this->createUrl('shop/toggleStatus', array('id'=>$shop->id, 'status'=>false)); ?>" target="ajaxTodo">禁用</a>
                <?php else: ?>
                <a href="<?php echo $this->createUrl('shop/toggleStatus', array('id'=>$shop->id, 'status'=>true)); ?>" target="ajaxTodo">启用</a>
                &nbsp;&nbsp;&nbsp;禁用
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('shop/del', array('id'=>$shop->id)); ?>" target="ajaxTodo" title="优惠券也会删除，请确定删除？">删除</a>
                &nbsp;
                <a href="<?php echo $this->createUrl('shop/edit', array('id'=>$shop->id)); ?>" target="dialog" width="450" height="510" maxable="false" mask="true" title="修改商户">修改</a>
                &nbsp;
                <a href="<?php echo $this->createUrl('coupon/edit', array('shop_id'=>$shop->id)); ?>" target="dialog" width="700" height="600" maxable="false" mask="true" title="添加/修改优惠券">优惠券</a>
                &nbsp;
                <a href="<?php echo $this->createUrl('shop/picture', array('shop_id'=>$shop->id)); ?>" target="navTab" rel="shop-picture">图片管理</a>
            </td>
        </tr>
        <?php endforeach; endif; ?>
    </table>
    <?php $this->widget('widget.Pager', array(
        'pages'=>$pages,
        'style'=>'width: 800px',
    )); ?>
</div>