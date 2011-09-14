<script type="text/javascript">
function validate(form, callback) {
    $select = $('div.select > input', form);
    if ($select.hasClass('required') && $select.val() == 0) {
        alertMsg.error('请选择一个广告类型')
        return false;
    }
	validateCallback(form, callback);
    return false;
}
</script>
<div class="pageContent">
    <form action="<?php echo $this->createUrl(''); ?>"  class="pageForm required-validate"
        enctype="multipart/form-data" onsubmit="return iframeCallback(this);" method="post">
        <div class="pageFormContent" layoutH="60">
            <input type="hidden" name="Form[id]" value="<?php echo $ad->id; ?>" />
            <div class="unit">
                <label>广告标题</label>
                <input type="text" name="Form[title]" value="<?php echo $ad->title; ?>" class="required" alt="广告标题不能为空" />
            </div>
            <div class="unit">
                <label>广告开始时间</label>
                <input type="text" name="Form[start_time]" value="<?php echo $ad->start_time ? date('Y-m-d H:i', $ad->start_time) : ''; ?>" class="required date" yearstart="0" yearend="5" formatter="yyyy-MM-dd HH:mm" />
                <a class="inputDateButton" href="#">选择</a>
            </div>
            <div class="unit">
                <label>广告结束时间</label>
                <input type="text" name="Form[end_time]" value="<?php echo $ad->end_time ? date('Y-m-d H:i', $ad->end_time) : ''; ?>" class="required date" yearstart="0" yearend="5" formatter="yyyy-MM-dd HH:mm" />
                <a class="inputDateButton" href="#">选择</a>
            </div>
            <div class="unit">
                <label url="<?php echo $this->createUrl('ad/getTypeHtml'); ?>">广告类型</label>
                <?php if (empty($ad->type)): ?>
                <select name="Form[type]" class="combox required" default="img" change="changeType">
                    <?php foreach ($types as $id=>$type): ?>
                    <option value="<?php echo $id ?>"><?php echo $type['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php else: ?>
                <input type="text" name="Form[type]" readonly="readonly" value="<?php echo $ad->type; ?>" style="width: 80px;" />
                <?php endif; ?>
            </div>
            <div class="container">
                <?php
                if (!empty($ad->type))
                    $this->actionGetTypeHtml($ad->type, $ad->param);
                else
                    $this->actionGetTypeHtml('img');
                ?>
            </div>
            <div class="unit">
                <label>广告排序</label>
                <input type="text" name="Form[sort]" value="<?php echo $ad->sort; ?>" class="required" alt="广告排序不能为空" />
            </div>
            <div class="unit">
                <label>状态</label>
                <span><input type="radio" name="Form[status]" value="1" <?php if (!isset($ad->status) || $ad->status) echo "checked='1'"; ?> />启用</span>
                <span><input type="radio" name="Form[status]" value="0" <?php if (isset($ad->status) && !$ad->status) echo "checked='1'"; ?> />停用</span>
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