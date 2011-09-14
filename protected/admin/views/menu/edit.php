<div class="pageContent">
    <form action="<?php echo $this->createUrl(''); ?>"  class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);" method="post">
        <div class="pageFormContent" layoutH="60">
            <input type="hidden" name="Form[id]" value="<?php echo isset($menu->id) ? $menu->id : ''; ?>" />
            <div class="unit">
                <label>菜单名</label>
                <input type="text" name="Form[name]" value="<?php echo isset($menu->name) ? $menu->name : ''; ?>" class="required" />
            </div>
            <div class="unit">
                <label>菜单路径</label>
                <input type="text" name="Form[url]" value="<?php echo isset($menu->url) ? $menu->url : ''; ?>" class="required" alt="填写网址或URL规则" />
            </div>
            <div class="unit">
                <label>菜单参数</label>
                <input type="text" name="Form[params]" value="<?php echo isset($menu->params) ? $menu->params : ''; ?>" />
            </div>
            <div class="unit">
                <label>排序</label>
                <input type="text" name="Form[sort]" value="<?php echo isset($menu->sort) ? $menu->sort : 99; ?>" />
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
