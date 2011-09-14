<ul class="menu">
    <?php $i = 0; foreach($menus as $menu): ?>
        <?php if (!Yii::app()->user->checkAccess($menu->url_route)) continue; ?>
        <li id="<?php echo $menu->url_route; ?>" <?php if($i == 0): ?>class="active"<?php endif; ?>>
            <a href="<?php echo $this->controller->createUrl("site/menu", array('id'=>$menu->id)); ?>"
                target="ajax" rel="sidebar" callback="changeMenu('<?php echo str_replace('/', '\\\\/', $menu->url_route); ?>');">
                <?php echo $menu->name; ?>
            </a>
        </li>
    <?php $i ++; endforeach;?>
</ul>
<script type="text/javascript">
function changeMenu(id) {
    $li = $('ul.menu li');
    $li.each(function () {
        $(this).removeClass('active');
    });
    $('#'+id).addClass('active');
}
</script>