<div id="leftside">
    <div id="sidebar_s">
        <div class="collapse">
            <div class="toggleCollapse"><div title="拉伸"></div></div>
        </div>
    </div>
    <div id="sidebar">
        <?php $this->renderInternal($this->getViewFile('menu'), array(
        	'menu'=>array_shift($this->headMenus),
        ));?>
    </div>
</div>
<div id="splitBar"></div>
<div id="splitBarProxy"></div>
<div id="container">
    <div id="navTab" class="tabsPage">
        <div class="tabsPageHeader">
            <div class="tabsPageHeaderContent">
                <ul class="navTab-tab">
                    <li tabid="main" class="main"><a href="javascript:void(0)"><span><span class="home_icon">主页</span></span></a></li>
                </ul>
            </div>
            <div class="tabsLeft">left</div>
            <div class="tabsRight">right</div>
            <div class="tabsMore">more</div>
        </div>
        <ul class="tabsMoreList">
            <li><a href="javascript:void(0)">主页</a></li>
        </ul>
        <div class="navTab-panel tabsPageContent">
            <div>
                <div class="accountInfo">
                    <div class="alertInfo">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="taskbar" style="left:0px; display:none;">
    <div class="taskbarContent">
        <ul></ul>
    </div>
    <div class="taskbarLeft taskbarLeftDisabled" style="display:none;">taskbarLeft</div>
    <div class="taskbarRight" style="display:none;">taskbarRight</div>
</div>