<div class="works center part clearfix">
  <aside class="column4 mright">

	<p><a href="<?php $this->e($l->gen('/blog'));?>" class="arrow">Blog</a></p>

	<ul>
	<?php
    if(isset($data['data.blog']['data.tumblr.feed'])) : foreach ($data['data.blog']['data.tumblr.feed'] as $item) :
        if (isset($item['body'])) :
        ?>
					<li>
							<p>
								<?php if (isset($item['body'])) {$this->e($item['body']);};?>
							</p>
							<?php if (isset($item['tag'])) :
    ?>
								<p><a href="http://ronymaltz.tumblr.com/tagged/<?php if (isset($item['tag'])) { $this->e($item['tag']); } ?>"><?php if (isset($item['tag'])) { $this->e($item['tag']); } ?></a><p>
							<?php
endif;?>

							<?php if (isset($item['link'])) :
    ?>
								<a href="<?php if (isset($item['link'])) {$this->e($item['link']);}?>" target="_blank" class="post-title">link</a>
							<?php
endif;?>
			            </li>
							<?php
        endif;
    endforeach; endif;
?>

	</ul>

  </aside>

  <section class="columnthird content clearfix">

	<?php if(isset($data['data.contents'])) : foreach ($data['data.contents'] as $item) :
?>

	<figure class="work">
        <?php if (isset($item['content.cover'])) : ?>
      <a href="<?php $this->e($l->gen('/content/' . $item['id']));?>" >
	    <img src="<?php $this->e('/public/media/' . $item['name'] . "_p" . $item['extension']);?>" alt="" >
	    <span class="zoom"></span>
	  </a>
        <?php endif; ?>
      <figcaption>
		<a href="<?php $this->e($l->gen('/content/' . $item['id']));?>#seta-ant" class="arrow pt-br">
			content: <?php if (isset($item['title'])) {$this->e($item['title']);};?>
		</a>
		<p class="pt-br">
			<?php if (isset($item['description'])) {$this->e($item['description']);};?>
		</p>
		<p class="pt-br">
			<?php if (isset($item['body'])) {$this->e($item['body']);};?>
		</p>
		<a href="<?php $this->e($l->gen('/content/' . $item['id']));?>#seta-ant" class="arrow en-us">
			work: <?php if (isset($item['title_en'])) {$this->e($item['title_en']);};?>
		</a>
		<p class="en-us">
			<?php if (isset($item['description_en'])) {$this->e($item['description_en']);};?>
		</p>
		<p class="en-us">
			<?php if (isset($item['body_en'])) {$this->e($item['body_en']);};?>
		</p>
      </figcaption>
    </figure>

	<?php
endforeach; endif;?>

	<?php if(isset($data['data.books'])) : foreach ($data['data.books'] as $item) :
?>

	<figure class="work">
      <a href="<?php $this->e($l->gen('/book/' . $item['id']));?>" >
	    <img src="<?php $this->e($l->genImg($item['capa.book'], 'p'));?>" alt="">
	    <span class="zoom"></span>
	  </a>

      <figcaption>
		<a href="<?php $this->e($l->gen('/book/' . $item['id']));?>#seta-ant" class="arrow pt-br">
			livro: <?php if (isset($item['title'])) {$this->e($item['title']);};?>
		</a>
		<p class="pt-br">
			<?php if (isset($item['description'])) {$this->e($item['description']);};?>
		</p>
		<p class="pt-br">
			<?php if (isset($item['body'])) {$this->e($item['body']);};?>
		</p>
		<a href="<?php $this->e($l->gen('/book/' . $item['id']));?>#seta-ant" class="arrow en-us">
			book: <?php if (isset($item['title_en'])) {$this->e($item['title_en']);};?>
		</a>
		<p class="en-us">
			<?php if (isset($item['description_en'])) {$this->e($item['description_en']);};?>
		</p>
		<p class="en-us">
			<?php if (isset($item['body_en'])) {$this->e($item['body_en']);};?>
		</p>
      </figcaption>
    </figure>

	<?php
endforeach; endif?>
  </section>

</div>
