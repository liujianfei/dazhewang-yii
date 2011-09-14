<div id="headNav">
    <div class="bg-l"></div>
    <ul>
        <?php foreach($menus as $menu): ?>
        <li><a href="<?php echo $this->controller->createUrl($menu->url); ?>" <?php if (!empty($menu->params)) echo 'target="'.$menu->params.'"'; ?>><?php echo $menu->name; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="bg-r"></div>
</div>