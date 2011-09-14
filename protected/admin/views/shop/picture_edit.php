<div class="pageContent">
    <form action="<?php echo $this->createUrl(''); ?>" method="post"  class="pageForm required-validate"
        <?php if ($multiple) : ?> onsubmit="return validateCallback(this, dialogAjaxDone);"
        <?php  else : ?> enctype="multipart/form-data" onsubmit="return iframeCallback(this);" <?php endif; ?>>
        <div class="pageFormContent"  layoutH="60">
            <?php if ($multiple): ?>
                <div id="fileQueue" class="fileQueue" style="height: 150px;"></div>
                <input id="multipleFileInput" type="file" name="picture"
                    uploader="admin/uploadify/scripts/uploadify.swf"
                    cancelImg="admin/uploadify/cancel.png"
                    script="<?php echo $this->createUrl(''); ?>"
                    scriptData="{session_id: '<?php echo Yii::app()->session->sessionID; ?>', shop_id:<?php echo $shop_id; ?>}"
                    fileQueue="fileQueue"
                    onComplete="pictureUploadifyComplete" />
            <?php else: ?>
            <div class="unit">
                <a href="<?php echo $picture->src; ?>"><?php echo Yii::app()->baseUrl.$picture->src; ?></a>
                <input type="file" name="picture" />
            </div>
            <?php endif; ?>
        </div>
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>