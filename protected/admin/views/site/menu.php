<div class="toggleCollapse"><h2><?php echo $menu->name; ?></h2><div title="收缩"></div></div>
<div class="accordion" fillSpace="sidebar">
    <div class="accordionContent">
        <ul class="tree treeFolder">
            <?php
            foreach($menu->Children as $child):
            if (!Yii::app()->user->checkAccess($child->url_route)) continue;
            ?>
            <li>
                <a href="<?php echo $this->createUrl($child->url_route); ?>"  <?php $child->url_params = @unserialize($child->url_params); if(isset($child->url_params['tabid'])) echo "rel=\"{$child->url_params['tabid']}\"";  ?> target="navTab"><?php echo $child->name; ?></a>
                <?php if (!empty($child->Children)): ?>
                <ul>
                <?php
                foreach ($child->Children as $c):
                if (!Yii::app()->user->checkAccess($c->url_route)) continue;
                ?>
                <li>
                    <a href="<?php echo $this->createUrl($c->url_route); ?>" <?php $c->url_params = @unserialize($c->url_params); if(isset($c->url_params['tabid'])) echo "rel=\"{$c->url_params['tabid']}\""; ?> target="navTab"><?php echo $c->name; ?></a>
                </li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>