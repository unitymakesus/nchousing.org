<div class="wef-default" style="max-width: <?php echo $width ?>px">
	<div class="row">
		<div class="col-3 text-center">
			<a href="https://facebook.com/<?php /** @noinspection PhpUndefinedVariableInspection */
			echo $fb_data['from']['id'] ?>" target="_blank" rel="nofollow">
				<img src="https://graph.facebook.com/<?php echo $fb_data['from']['id'] ?>/picture" />
			</a>
		</div>
		<div class="col-9 pl-none">
			<a href="https://facebook.com/<?php echo $fb_data['from']['id'] ?>" target="_blank" rel="nofollow">
				<span class="title"><?php echo $fb_data['from']['name'] ?></span>
			</a>
			<br>
			<?php if(isset($fb_data['from']['category'])) : ?>
				<?php echo $fb_data['from']['category'].'<br>'  ?>
			<?php endif; ?>
			<a href="https://www.facebook.com/<?php echo $fb_data['id'] ?>" target="_blank" rel="nofollow"><?php echo $fb_data['name'] ?></a>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-12 text-center">
			<div class="text-center album-thumbs">
			<?php
			if(isset($fb_data['photos']))
				foreach ($fb_data['photos']['data'] as $pic) {
					$data_title = isset($pic['name']) ? $pic['name'] :  '';
					?>
					<a href="<?php echo $pic['source'] ?>" <?php echo WP_Embed_FB_Plugin::get_option('lightbox_att') ?> <?php echo !empty($data_title) ? WP_Embed_FB_Plugin::lightbox_title($data_title) : '' ?> >
						<img class="thumbnail" src="<?php echo $pic['picture'] ?>" />
					</a>
					<?php
				}
			?>
			</div>
		</div>
	</div>
</div>
