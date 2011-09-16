<div class="banner-title" style="margin:0px;">
	<span>会员活动</span><a href="<?php ?>">更多&gt;</a>
</div>
<div id="col">
	<div class="sliderbox">
		<?php foreach($actives as $key=>$active): ?>
		<div class="slider" status="close">
			<div class="title">
				<span class="left">【<?php echo $categorys[$active->id]->name; ?>】</span>
				<span class="right"><?php echo $active->title; ?></span>
			</div>
			<div class="content">
				<img src="<?php echo $active->cover_img_small; ?>" width="104" height="105" />
				<p><span class="red">尊敬的会员们：</span><?php echo $active->desc; ?></p>
				<p><a class="red" href="<?php ?>">查看详情&gt;&gt;</a></p>
				<div class="clear"></div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
    