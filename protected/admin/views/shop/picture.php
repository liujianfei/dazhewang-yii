<div class="pageContent">
    <table class="list" width="800">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>图片路径</th>
            <th>上传时间</th>
            <th>修改时间</th>
            <th width="30">排序</th>
            <th width="120">操作</th>
        </tr>
        <?php if (empty($pictures)): ?>
        <tr>
            <td colspan="6">无数据</td>
        </tr>
        <tr>
            <td colspan="6"><a class="button" href="<?php echo $this->createUrl("shop/uploadMultiple", array('shop_id'=>$shop_id)); ?>" target="dialog" maxable="false"><span>上传图片</span></a></td>
        </tr>
        <?php else: foreach ($pictures as $picture): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $picture->id ?>" /></td>
            <td><?php echo $picture->src; ?></td>
            <td><?php echo date("Y-m-d H:i:s", $picture->create_time); ?></td>
            <td><?php echo date("Y-m-d H:i:s", $picture->update_time); ?></td>
            <td>
                <span id="<?php echo $picture->id ?>" name="sort" title="点击即可修改排序" url="<?php echo $this->createUrl('picture/changeSort'); ?>" class="changeBtn"><?php echo $picture->sort; ?></span>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('shop/del', array('id'=>$picture->id)); ?>" target="ajaxTodo" title="优惠券也会删除，请确定删除？">删除</a>
                &nbsp;&nbsp;
                <a href="<?php echo $this->createUrl('shop/pictureReupload', array('id'=>$picture->id)); ?>" target="dialog" width="400" height="210" maxable="false" mask="true" title="重新上传">重新上传</a>
            </td>
        </tr>
        <?php endforeach; endif; ?>
    </table>
</div>