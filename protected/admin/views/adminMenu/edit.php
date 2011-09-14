<div class="pageContent">
    <form action="<?php echo $this->createUrl(''); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);" method="post">
        <div class="pageFormContent" layoutH="60">
            <input type="hidden" name="Form[id]" value="<?php echo $menu->id; ?>" />
            <div class="unit">
                <label>菜单名</label>
                <input type="text" name="Form[name]" value="<?php echo $menu->name; ?>" class="required" alt="菜单名不能为空" />
            </div>
            <div class="unit">
                <label>菜单路径</label>
                <input type="text" name="Form[url_route]" value="<?php echo $menu->url_route; ?>" class="required" alt="菜单路径不能为空" />
            </div>
            <div class="unit">
                <label>标签ID</label>
                <input type="text" name="Form[url_params][tabid]" value="<?php $params = @unserialize($menu->url_params); echo $params['tabid']; ?>" />
            </div>
            <div class="unit">
                <label>父菜单</label>
                <select name="Form[parent_id]" class="combox">
                    <option value="0">无</option>
                    <?php foreach($parents as $parent): ?>
                    <option value="<?php echo $parent->id; ?>" <?php if($menu->parent_id == $parent->id) echo 'selected="1"'; ?>><?php echo $parent->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="unit">
                <label>排序</label>
                <input type="text" name="Form[sort]" value="<?php echo $menu->sort; ?>" />
            </div>
            <div class="unit">
                <label>状态</label>
                <span><input type="radio" name="Form[status]" value="1" <?php if (!isset($menu->status) || $menu->status) echo "checked='1'"; ?> />启用</span>
                <span><input type="radio" name="Form[status]" value="0" <?php if (isset($menu->status) && !$menu->status) echo "checked='1'"; ?> />停用</span>
            </div>
        </div>
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
