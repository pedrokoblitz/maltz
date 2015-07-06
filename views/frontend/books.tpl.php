<div class="works center part clearfix">
  <header class="title">
	<p class="fleft pt-br">Livros</p>
	<p class="fleft en-us">Books</p>
  </header>
  <aside class="column4 mright">
	<p class="mbottom pt-br"><?php if (isset($sidebar)) {$this->e($sidebar['body']);}?></p>
	<p class="mbottom en-us"><?php if (isset($sidebar)) {$this->e($sidebar['body_en']);}?></p>
  </aside>

  <section class="columnthird content clearfix">

	<?php if (isset($data['data.list']) && is_array($data['data.list']) && !empty($data['data.list'])) : foreach ($data['data.list'] as $item) :
?>

	<figure class="work">
      <a href="<?php $this->e($l->gen('/book/' . $item['book_id']));?>" >
	    <img src="<?php $this->e($l->gen('/public/media/' . $item['book.cover']['name'] . '_p.' . $item['book.cover']['extension']));?>" alt="" >
	    <span class="zoom"></span>
	  </a>

      <figcaption>
		<a href="<?php $this->e($l->gen('/book/' . $item['book_id']));?>#seta-ant" class="arrow pt-br">
			<?php $this->e($item['title']);?>
		</a>
		<p class="pt-br">
			<?php $this->e($item['description']);?>
		</p>
		<p class="pt-br">
			<?php $this->e($item['body']);?>
		</p>
		<a href="<?php $this->e($l->gen('/book/' . $item['book_id']));?>#seta-ant" class="arrow en-us">
			<?php $this->e($item['title_en']);?>
		</a>
		<p class="en-us">
			<?php $this->e($item['description_en']);?>
		</p>
		<p class="en-us">
			<?php $this->e($item['body_en']);?>
		</p>
      </figcaption>
    </figure>

	<?php
endforeach; endif;?>

  </section>

</div>
