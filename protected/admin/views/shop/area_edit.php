<div class="pageContent">
    <form action="<?php echo $this->createUrl(''); ?>"  class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);" method="post">
        <div class="pageFormContent" layoutH="60">
            <input type="hidden" name="Form[id]" value="<?php echo isset($area->id) ? $area->id : ''; ?>" />
            <div class="unit">
                <label>地区名称</label>
                <input type="text" name="Form[name]" value="<?php echo isset($area->name) ? $area->name : ''; ?>" class="required" />
            </div>
            <div class="unit">
                <label>上级地区</label>
                <select name="Form[parent_id]" class="combox required" default="<?php echo isset($area->parent_id) ? $area->parent_id : 0; ?>">
                    <option value="0">无</option>
                    <?php foreach ($areas as $a): ?>
                    <option value="<?php echo $a->id; ?>" <?php if ($a->id == $area->parent_id) echo 'selected="1"' ?>><?php echo $a->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="unit">
                <label>状态</label>
                <span><input type="radio" name="Form[status]" value="1" <?php if (!isset($area->status) || $area->status) echo "checked='1'"; ?> />启用</span>
                <span><input type="radio" name="Form[status]" value="0" <?php if (isset($area->status) && !$area->status) echo "checked='1'"; ?> />停用</span>
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