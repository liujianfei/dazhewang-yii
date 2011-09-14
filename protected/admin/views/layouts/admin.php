<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=7" />
    <title>打折网管理后台</title>

    <link href="admin/default/style.css" rel="stylesheet" type="text/css" />
    <link href="admin/css/core.css" rel="stylesheet" type="text/css" />
    <link href="admin/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="favicon.ico" type="/image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="/image/x-icon" />
    <link href="admin/css/multiple.css" rel="stylesheet" type="text/css" />
    <!--[if IE]>
    <link href="admin/css/ieHack.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script src="admin/javascripts/speedup.js" type="text/javascript"></script>
    <script src="admin/javascripts/jquery.js" type="text/javascript"></script>
    <script src="admin/javascripts/jquery.cookie.js" type="text/javascript"></script>
    <script src="admin/javascripts/jquery.validate.js" type="text/javascript"></script>
    <script src="admin/javascripts/jquery.bgiframe.js" type="text/javascript"></script>
    <script src="admin/javascripts/jquery.textchange.js" type="text/javascript"></script>
    <script src="admin/xheditor/xheditor-1.1.6-zh-cn.min.js" type="text/javascript"></script>
    <script src="admin/uploadify/scripts/swfobject.js" type="text/javascript"></script>
    <script src="admin/uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>

    <script src="admin/javascripts/dwz.core.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.util.date.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.validate.method.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.regional.zh.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.barDrag.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.drag.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.tree.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.accordion.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.ui.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.theme.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.switchEnv.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.alertMsg.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.contextmenu.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.navTab.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.tab.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.resize.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.jDialog.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.dialogDrag.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.cssTable.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.stable.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.taskBar.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.ajax.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.pagination.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.database.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.datepicker.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.effects.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.panel.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.checkbox.js" type="text/javascript"></script>
    <script src="admin/javascripts/dwz.combox.js" type="text/javascript"></script>
    <!-- 引用自定义js -->
    <script src="admin/javascripts/admin.js" type="text/javascript"></script>

    <script type="text/javascript">
    $(function(){
        DWZ.init("assets/dwz.frag.xml", {
            loginUrl:"<?php echo $this->createUrl('site/login'); ?>",  // 跳到登录页面
            debug: false,    // 调试模式 【true|false】
            callback: function(){
                initEnv();
            }
        });
    });
    //清理浏览器内存,只对IE起效,FF不需要
    if ($.browser.msie) {
        window.setInterval("CollectGarbage();", 10000);
    }
    </script>
</head>
<body scroll="no">
    <div id="layout">
        <div id="header">
            <div class="headerNav">
                <span class="logo">嘉兴12580打折网后台管理</span>
                <ul class="nav">
                    <li>您好：<?php echo Yii::app()->user->name; ?>，您上次的登录时间为：2011/4/27 15:54</li>
                    <li><a href="<?php echo $this->createUrl('auth/changePwd'); ?>" target="dialog">修改密码</a></li>
                    <li><a href="<?php echo Yii::app()->baseUrl; ?>" target="_blank">网站首页</a></li>
                    <li><a href="<?php echo Yii::app()->homeUrl; ?>">后台首页</a></li>
                    <li><a href="<?php echo $this->createUrl('site/logout'); ?>">退出</a></li>
                </ul>
                <?php $this->widget('application.widget.HeadMenu'); ?>
            </div>
        </div>
        <?php echo $content; ?>
    </div>
    <div id="footer"><a href="http://web.jxrsrc.com/C24763/">中国移动浙江公司嘉兴分公司</a><br />Powered by <a href="http://bbs.dwzjs.com/">DWZ</a> & <a href="www.yiiframework.com">YII</a></div>
    <div class="resizable"></div>
    <div class="shadow" style="width:508px; top:148px; left:296px;">
        <div class="shadow_h">
            <div class="shadow_h_l"></div>
            <div class="shadow_h_r"></div>
            <div class="shadow_h_c"></div>
        </div>
        <div class="shadow_c">
            <div class="shadow_c_l" style="height:296px;"></div>
            <div class="shadow_c_r" style="height:296px;"></div>
            <div class="shadow_c_c" style="height:296px;"></div>
        </div>
        <div class="shadow_f">
            <div class="shadow_f_l"></div>
            <div class="shadow_f_r"></div>
            <div class="shadow_f_c"></div>
        </div>
    </div>
    <div id="alertBackground" class="alertBackground"></div>
    <div id="dialogBackground" class="dialogBackground"></div>

    <div id='background' class='background'></div>
    <div id='progressBar' class='progressBar'>数据加载中，请稍等...</div>
</body>
</html>