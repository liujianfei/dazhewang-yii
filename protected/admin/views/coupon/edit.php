<div class="pageContent">
    <form action="<?php echo $this->createUrl(''); ?>" class="pageForm required-validate"
        enctype="multipart/form-data" onsubmit="return iframeCallback(this);" method="post">
        <div class="pageFormContent" layoutH="60">
            <input type="hidden" name="Form[id]" value="<?php echo $coupon->id; ?>" />
            <div class="unit">
                <label>商户名</label>
                <span style="line-height: 21px;"><?php echo !empty($coupon->Shop) ? $coupon->Shop->name : $shop->name; ?></span>
            </div>
            <div class="unit">
                <label>优惠券名</label>
                <input name="Form[name]" class="required" type="text" value="<?php echo $coupon->name; ?>" alt="优惠券名不能为空" style="width: 200px;" />
            </div>
            <div class="unit">
                <label>封面图片</label>
                <?php if (!empty($coupon->cover_img)): ?>
                <span style="line-height: 21px;">
                <a href="<?php echo $coupon->cover_img; ?>" target="_blank">查看</a>
                <a name="cover_img" class="reUpload" href="#">重新上传</a>
                </span>
                <?php else: ?>
                <input type="file" name="cover_img" />
                <?php endif; ?>
            </div>
            <div class="unit">
                <label>优惠开始时间</label>
                <input name="Form[begin_time]" class="date required" type="text" value="<?php echo !empty($coupon->begin_time) ? date('Y-m-d H:i', $coupon->begin_time) : ''; ?>"
                    yearstart="0" yearend="5" formatter="yyyy-MM-dd HH:mm" />
            </div>
            <div class="unit">
                <label>优惠结束时间</label>
                <input name="Form[end_time]" class="date required" type="text" value="<?php echo !empty($coupon->end_time) ? date('Y-m-d H:i', $coupon->end_time) : ''; ?>"
                    yearstart="0" yearend="5" formatter="yyyy-MM-dd HH:mm" />
            </div>
            <div class="unit">
                <label>优惠券内容</label>
                <textarea name="Form[content]" class="editor textInput" tools="mfull" style="width: 300px; height: 250px;"><?php echo $coupon->content; ?></textarea>
            </div>
            <div class="unit">
                <label>下载次数</label>
                <input name="Form[down_count]" type="text" value="<?php echo !empty($coupon->down_count) ? $coupon->down_count : 0; ?>" style="width: 30px;" />
            </div>
            <div class="unit">
                <label>彩信优惠券ID</label>
                <input name="Form[mms_id]" type="text"value="<?php echo $coupon->mms_id; ?>" style="width: 80px;" />
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