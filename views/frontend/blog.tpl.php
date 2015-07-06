<div class=" center blog part clearfix">
  <header class="title">
    <p class="fleft">Blog</p>
  </header>
  <section class="columnthird content mright">

		<?php if (isset($data['data.tumblr.feed'])) : foreach ($data['data.tumblr.feed'] as $data) :
?>
				<?php if (isset($data['body'])) :
?>

			<article class="post">
				<div class="entry">

					<p>
						<?php $this->e($data['body']);?>
					</p>

					<?php if (isset($data['tag'])) :
?>
						<p><a href="http://ronymaltz.tumblr.com/tagged/<?php $this->e($data['tag']);?>"><?php $this->e($data['tag']);?></a><p>
					<?php
endif;?>

					<?php if (isset($data['link'])) :
?>
						<a href="<?php $this->e($data['link'])?>" target="_blank" class="post-title">link</a>
					<?php
endif;?>

				</div>
			</article>

				<?php
endif;?>
		<?php
endforeach; endif;?>

  </section>
  <aside class="column4 sidebar">
    <div class="widget">
   		<div class="pt-br"><?php if (isset($sidebar)) {
            $this->e($sidebar['body']);
} ?></div>
		<div class="en-us"><?php if (isset($sidebar)) {
            $this->e($sidebar['body_en']);
}?></div>
    </div>
  </aside>
</div>
