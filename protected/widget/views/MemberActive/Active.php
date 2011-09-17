<div class="banner-title" style="margin:0px;">
	<span>会员活动</span><a href="<?php ?>">更多&gt;</a>
</div>
<div id="col">
	<div class="sliderbox">
		<?php foreach($actives as $key=>$active): ?>
		<?php if($key>3)
		{
			break;
		}
		if($key==1)
		{
			$status="open";
		}else
		{
			$status="close";
		}
		?>
		<div class="slider" status="<?php echo $status;?>">
			<div class="title">
				<span class="left <?php echo $key==1?'status="open"':'status="close"'; ?>">【<?php echo $categorys[$active->id]->name; ?>】</span>
				<span class="right"><?php echo $active->title; ?></span>
			</div>
			<div class="content" <?php if($status=="open"){
				echo 'style="display:block"';
			}else{
			echo 'style="display:none"';
			}?>>
				<img src="<?php echo $active->cover_img_small; ?>" width="105" height="105" />
				<p><span class="red">尊敬的会员们：</span><?php echo $active->desc; ?></p>
				<p><a class="red" href="<?php ?>">查看详情&gt;&gt;</a></p>
				<div class="clear"></div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
    