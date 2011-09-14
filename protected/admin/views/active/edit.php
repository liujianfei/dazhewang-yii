<div class="pageContent">
    <form action="<?php echo $this->createUrl(''); ?>"  class="pageForm required-validate"
        enctype="multipart/form-data" onsubmit="return iframeCallback(this);" method="post">
        <div class="pageFormContent" layoutH="60">
            <input type="hidden" name="Form[id]" value="<?php echo $active->id; ?>" />
            <div class="unit">
                <label>活动标题</label>
                <input type="text" name="Form[title]" value="<?php echo $active->title; ?>" class="required" alt="活动标题不能为空" style="width: 250px;" />
            </div>
            <div class="unit">
                <label>封面小图</label>
                <?php if (!empty($active->cover_img_small)): ?>
                <span style="line-height: 21px;">
                <a href="<?php echo $active->cover_img_small; ?>" target="_blank">查看</a>
                <a name="cover_img_small" class="reUpload" href="#">重新上传</a>
                </span>
                <?php else: ?>
                <input type="file" name="cover_img_small" />
                <?php endif; ?>
            </div>
            <div class="unit">
                <label>封面大图</label>
                <?php if (!empty($active->cover_img_big)): ?>
                <span style="line-height: 21px;">
                <a href="<?php echo $active->cover_img_big; ?>" target="_blank">查看</a>
                <a name="cover_img_big" class="reUpload" href="#">重新上传</a>
                </span>
                <?php else: ?>
                <input type="file" name="cover_img_big" />
                <?php endif; ?>
            </div>
            <div class="unit">
                <label>活动地址</label>
                <input type="text" name="Form[address]" value="<?php echo $active->address; ?>" class="required" alt="活动地址不能为空" style="width: 150px;" />
            </div>
            <div class="unit">
                <label>活动所需积分</label>
                <input type="text" name="Form[point]" value="<?php echo $active->point ? $active->point : 0; ?>" class="required" alt="活动积分不能为空" style="width: 50px;" />
            </div>
            <div class="unit">
                <label>报名开始时间</label>
                <input type="text" name="Form[begin_time]" value="<?php echo !empty($active->begin_time) ? date('Y-m-d H:i', $active->begin_time) : ''; ?>" class="date required" yearstart="0" yearend="5" formatter="yyyy-MM-dd HH:mm" />
            </div>
            <div class="unit">
                <label>报名结束时间</label>
                <input type="text" name="Form[end_time]" value="<?php echo !empty($active->end_time) ? date('Y-m-d H:i', $active->end_time) : ''; ?>" class="date required" yearstart="0" yearend="5" formatter="yyyy-MM-dd HH:mm" />
            </div>
            <div class="unit">
                <label>活动时间</label>
                <input type="text" name="Form[start_time]" value="<?php echo $active->start_time?>" class="required" alt="结束时间不能为空" />
            </div>
            <div class="unit">
                <label>活动类型</label>
                <select name="Form[category_id]" class="combox required" default="<?php echo $active->category_id; ?>">
                    <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="unit">
                <label>活动内容</label>
                <textarea name="Form[content]" class="editor textInput" tools="mfull" style="width: 300px; height: 250px;"><?php echo $active->content; ?></textarea>
            </div>
            <div class="unit">
                <label>活动排序</label>
                <input type="text" name="Form[sort]" value="<?php echo empty($active->sort) ? '99' : $active->sort; ?>" class="required" alt="活动排序不能为空" style="width: 50px" />
            </div>
            <div class="unit">
                <label>状态</label>
                <span><input type="radio" name="Form[status]" value="1" <?php if (empty($active->status) || $active->status) echo "checked='1'"; ?> />启用</span>
                <span><input type="radio" name="Form[status]" value="0" <?php if (!empty($active->status) && !$active->status) echo "checked='1'"; ?> />停用</span>
            </div>
            <div class="unit">
                <label>是否上线</label>
                <span><input type="radio" name="Form[preview]" value="1" <?php if (empty($active->preview) || $active->preview) echo "checked='1'"; ?> />是</span>
                <span><input type="radio" name="Form[preview]" value="0" <?php if (!empty($active->preview) && !$active->preview) echo "checked='1'"; ?> />否</span>
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