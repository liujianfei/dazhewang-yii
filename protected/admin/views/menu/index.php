<script type="text/javascript">
function changeSort(dom)
{
    $(dom).hide();
    $(dom).next().show().focus().select()
        .unbind('keypress')
        .keypress(function (e) {
            if (e.which == 13) { // Enter
                $(this).unbind('blur').blur();
                changeSortEvent(this);
            }
        })
        .blur(function () {
            $(this).unbind('blur');
            changeSortEvent(this);
        });
}

function changeSortEvent(dom)
{
    $dom = $(dom);
    id = $dom.attr('id');
    val = $dom.val();
    url = "<?php echo $this->createUrl('menu/changeSort'); ?>";
    data = {id: id, sort: val};
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: 'json',
        success: function (response) {
            DWZ.ajaxDone(response);
            $dom.hide();
            $dom.prev().text(val).show();
        },
        error: DWZ.ajaxError
    });
}
</script>
<?php $this->widget('widget.Search', array(
    'panleStyle'=>'width: 690px;',
    'searchCondition'=>array(
        '菜单名：'=>array('type'=>'text', 'name'=>'name', 'alt'=>'支持模糊搜索'),
    ),
)); ?>
<div class="pageContent">
    <div class="panelBar" style="width: 700px">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo $this->createUrl("menu/edit") ?>" target="dialog" width="280" height="260"" resizable="false" maxable="false" mask="true" title="添加菜单。"><span>添加菜单</span></a></li>
            <li><a class="delete" href="<?php echo $this->createUrl("menu/del"); ?>" target="selectedTodo" title="确定删除选定数据吗？" rel="id[]" ><span>删除选定</span></a></li>
        </ul>
    </div>
    <table class="list" width="700">
        <tr>
            <th width="20"><input type="checkbox" class="checkboxCtrl" group="id[]" /></th>
            <th>菜单名</th>
            <th width="30">排序</th>
            <th width="100">状态</th>
            <th width="120">操作</th>
        </tr>
        <?php if ($menus !== null) foreach ($menus as $menu): ?>
        <tr>
            <td><input type="checkbox" name="id[]" value="<?php echo $menu->id ?>" /></td>
            <td><?php echo $menu->name; ?></td>
            <td>
                <span id="<?php echo $menu->id ?>" name="sort" title="点击即可修改排序" url="<?php echo $this->createUrl('menu/changeSort'); ?>" class="changeBtn"><?php echo $menu->sort; ?></span>
            </td>
            <td>
                <?php if ($menu->status): ?>
                启用&nbsp;&nbsp;&nbsp;
                 <a href="<?php echo $this->createUrl('menu/toggleStatus', array('id'=>$menu->id, 'status'=>false)); ?>" target="ajaxTodo">禁用</a>
                <?php else: ?>
                <a href="<?php echo $this->createUrl('menu/toggleStatus', array('id'=>$menu->id, 'status'=>true)); ?>" target="ajaxTodo">启用</a>
                &nbsp;&nbsp;&nbsp;禁用
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo $this->createUrl('menu/del', array('id'=>$menu->id)); ?>" target="ajaxTodo" title="请确定删除？">删除</a>
                <a href="<?php echo $this->createUrl('menu/edit', array('id'=>$menu->id)); ?>" target="dialog" width="280" height="260" resizable="false" maxable="false" mask="true" title="修改菜单">修改</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>