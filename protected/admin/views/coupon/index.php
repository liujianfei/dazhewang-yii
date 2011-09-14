<?php $this->widget('widget.Search', array(
    'panleStyle'=>'width: 790px;',
    'searchCondition'=>array(
        '商户名：'=>array('type'=>'text', 'name'=>'shop_name', 'defaultValue'=>$shop_name, 'alt'=>'支持模糊搜索'),
    ),
)); ?>
<div class="pageContent">
    <div class="panelBar" style="width: 800px">
        <ul class="toolBar">
            <li><a class="delete" href="<?php echo $this->createUrl("coupon/del"); ?>" target="selectedTodo" title="确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
        </ul>
    </div>
    <table class="list" width="800">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>商户名称</th>
            <th>优惠券名称</th>
            <th width="100">优惠开始时间</th>
            <th width="100">优惠结束时间</th>
            <th width="60">下载次数</th>
            <th width="70">商户状态</th>
            <th width="70">操作</th>
        </tr>
        <?php if (empty($coupons)): ?>
        <tr>
            <td colspan="7">无数据</td>
        </tr>
        <?php else: foreach ($coupons as $coupon): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $coupon->id ?>" /></td>
            <td><?php echo $coupon->Shop->name; ?></td>
            <td><?php echo $coupon->name; ?></td>
            <td><?php echo date('Y-m-d H:i', $coupon->begin_time); ?></td>
            <td><?php echo date('Y-m-d H:i', $coupon->end_time); ?></td>
            <td>
                <span id="<?php echo $coupon->id ?>" name="count" title="点击即可修改下载量" url="<?php echo $this->createUrl('coupon/changeDownCount'); ?>" class="changeBtn"><?php echo $coupon->down_count; ?></span>
            </td>
            <td>
                <?php if ($coupon->Shop->status): ?>
                启用&nbsp;&nbsp;&nbsp;
                 <a href="<?php echo $this->createUrl('shop/toggleStatus', array('id'=>$coupon->Shop->id, 'status'=>false)); ?>" target="ajaxTodo">禁用</a>
                <?php else: ?>
                <a href="<?php echo $this->createUrl('shop/toggleStatus', array('id'=>$coupon->Shop->id, 'status'=>true)); ?>" target="ajaxTodo">启用</a>
                &nbsp;&nbsp;&nbsp;禁用
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('coupon/del', array('id'=>$coupon->id)); ?>" target="ajaxTodo" title="请确定删除？">删除</a>&nbsp;&nbsp;&nbsp;
                <a href="<?php echo $this->createUrl('coupon/edit', array('id'=>$coupon->id)); ?>" target="dialog" width="700" height="600" maxable="false" mask="true" title="修改优惠券">修改</a>
            </td>
        </tr>
        <?php endforeach; endif; ?>
    </table>
    <?php $this->widget('widget.Pager', array(
        'pages'=>$pages,
        'style'=>'width: 800px',
    )); ?>
</div>