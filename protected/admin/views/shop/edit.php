<script type="text/javascript">
var categories = <?php $this->getCategory(); ?>;
function changeShopCategory(id)
{
    var result = new Array();
    result.push([0, '请选择']);
    for (i = 0; i < categories.length; i++)
    {
        if (categories[i].parent == id)
        {
            result.push([categories[i].id, categories[i].name]);
        }
    }
    return result;
}
</script>
<div class="pageContent">
    <form action="<?php echo $this->createUrl(''); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);" method="post">
        <div class="pageFormContent" layoutH="60">
            <input type="hidden" name="Form[id]" value="<?php echo !empty($shop->id) ? $shop->id : ''; ?>" />
            <div class="unit">
                <label>商户名</label>
                <input type="text" name="Form[name]" value="<?php echo !empty($shop->name) ? $shop->name : ''; ?>" class="required" />
            </div>
            <div class="unit">
                <label>联系电话</label>
                <input type="text" name="Form[phone]" value="<?php echo !empty($shop->phone) ? $shop->phone : ''; ?>" class="required" />
            </div>
            <div class="unit">
                <label>商户类别</label>
                <select ref="Form[categort_id]" change="changeShopCategory" default="<?php echo !empty($shop->category_id) ? $shop->Category->parent_id : 1; ?>" class="combox">
                    <?php foreach ($category_parent as $category): ?>
                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="Form[categort_id]" default="<?php echo !empty($shop->category_id) ? $shop->category_id : 0; ?>" class="combox required">
                    <option value="0">请选择</option>
                    <?php if (!empty($category_childrens)) foreach ($category_childrens as $category): ?>
                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="unit">
                <label>商户地区</label>
                <select name="Form[area_id]" class="combox required" default="<?php echo !empty($shop->area_id) ? $shop->area_id : 1; ?>">
                    <option value="0">请选择</option>
                    <?php foreach ($areas as $area): ?>
                    <option value="<?php echo $area->id; ?>"><?php echo $area->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="unit">
                <label>是否支持刷卡</label>
                <span><input type="radio" name="Form[support_cart]" value="1" <?php if (empty($shop->support_cart) || $shop->support_cart) echo "checked='1'"; ?> />是</span>
                <span><input type="radio" name="Form[support_cart]" value="0" <?php if (!empty($shop->support_cart) && !$shop->support_cart) echo "checked='1'"; ?> />否</span>
            </div>
            <div class="unit">
                <label>是否有车位</label>
                <span><input type="radio" name="Form[has_parking]" value="1" <?php if (empty($shop->has_parking) || $shop->has_parking) echo "checked='1'"; ?> />是</span>
                <span><input type="radio" name="Form[has_parking]" value="0" <?php if (!empty($shop->has_parking) && !$shop->has_parking) echo "checked='1'"; ?> />否</span>
            </div>
            <div class="unit">
                <label>折扣内容</label>
                <input type="text" name="Form[discount]" value="<?php echo isset($shop->discount) ? $shop->discount : ''; ?>" class="required" style="width: 250px;" />
            </div>
            <div class="unit">
                <label>详细地址</label>
                <input type="text" name="Form[address]" value="<?php echo isset($shop->address) ? $shop->address : ''; ?>" class="required" style="width: 200px;" />
            </div>
            <div class="unit">
                <label>人均消费</label>
                <input type="text" name="Form[capita]" value="<?php echo isset($shop->capita) ? $shop->capita : ''; ?>" class="required" style="width: 80px;" />
            </div>
            <div class="unit">
                <label>商家介绍</label>
                <textarea name="Form[description]" class="editor textInput" tools="mfull" style="width: 250px; height: 200px;"><?php echo isset($shop->description) ? $shop->description : ''; ?></textarea>
            </div>
            <div class="unit">
                <label>点击量</label>
                <input type="text" name="Form[click_count]" value="<?php echo !empty($shop->click_count) ? $shop->click_count : 0; ?>" class="required" style="width: 50px;" />
            </div>
            <div class="unit">
                <label>排序</label>
                <input type="text" name="Form[sort]" value="<?php echo !empty($shop->sort) ? $shop->sort : 99; ?>" class="required" style="width: 50px;" />
            </div>
            <div class="unit">
                <label>状态</label>
                <span><input type="radio" name="Form[status]" value="1" <?php if (!isset($shop->status) || $shop->status) echo "checked='1'"; ?> />启用</span>
                <span><input type="radio" name="Form[status]" value="0" <?php if (isset($shop->status) && !$shop->status) echo "checked='1'"; ?> />停用</span>
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