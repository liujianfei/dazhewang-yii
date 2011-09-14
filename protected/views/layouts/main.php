<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=7" />
    <title><?php echo Yii::app()->name.' - '.$this->pageTitle; ?></title>
    <meta name="keywords" content="<?php echo $this->keywords;?>" />
    <meta name="description" content="<?php echo $this->description;?>" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <?php foreach ($this->cssFiles as $css): if (is_file(Yii::app()->basePath.'/../css/'.$css)): ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/../css/'.$css; ?>" />
    <?php endif; endforeach; ?>
    <script type="text/javascript">
    function addFavorite() {
        if (document.all) { window.external.addFavorite('http://www.12580gogo.com','12580打折网'); }
        else if (window.sidebar) { window.sidebar.addPanel('12580打折网', 'http://www.12580gogo.com', ""); }
    }

    function setHomepage() {
        if (document.all) {
            document.body.style.behavior='url(#default#homepage)';
            document.body.setHomePage('http://www.12580gogo.com');
        }
        else if (window.sidebar) {
            if(window.netscape) { try { netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect"); } catch (e) { } }
            var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);
            prefs.setCharPref('browser.startup.homepage','http://www.12580gogo.com');
        }
    }
    </script>
</head>
<body>
    <div id="top">
        <div class="layout">
            <div class="layout-left">
                您好，欢迎来到12580打折网。出门消费，12580帮您省更多！
                <a href="">登陆</a>
                <a href="">立即注册</a>
            </div>
            <div class="layout-right">
                <a href="">将12580打折网放到桌面</a>
                <a href="javascript: setHomepage();">设为首页</a>
                <a href="javascript: addFavorite();">加入收藏</a>
            </div>
        </div>
    </div>
    <div id="body">
        <div class="top">
            <div class="logo">
                <a href="<?php echo Yii::app()->homeUrl; ?>"><img src="images/logo.png" alt="logo"  /></a>
            </div>
            <div class="weather">
                <iframe src="http://m.weather.com.cn/m/pn3/weather.htm?id=101210301T " width="225" height="20" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
            </div>
            <div id="search">
                <div class="title"><div class="c-t-l"></div>商户<div class="c-t-r"></div></div>
                <div class="content">
                    <div class="c-b-l"></div>
                    <form action="<?php echo $this->createUrl('site/search'); ?>" method="get">
                        <input id="keywords" type="text" name="keyword">
                        <button type="submit"></button>
                    </form>
                    <div class="c-t-r"></div>
                    <div class="c-b-r"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php $this->widget('widget.HeadNav'); ?>
        <a href="#"><img src="images/fore-step.jpg" /></a>
        <?php echo $content; ?>
    </div>
    <div id="footer">
        <div class="links">
            <a href="javascript://;" onclick="window.scrollTo(0,0);">TOP</a>
        </div>
        <a href="http://web.jxrsrc.com/C24763/">中国移动浙江公司嘉兴分公司</a><br />
        Powered by <a href="www.yiiframework.com">YII Framework</a>
    </div>
</body>
</html>