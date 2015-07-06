<div class="main center">
 <section class="part clearfix">
    <header class="title clearfix">
    <div class="column4 mright">
		<h5 class="pt-br"><?php $this->e($data['data.book']['title']);?></h5>
		<h5 class="en-us"><?php $this->e($data['data.book']['title_en']);?></h5>
		<div class="pt-br"><?php $this->e($data['data.book']['body']);?></div>
		<div class="en-us"><?php $this->e($data['data.book']['body_en']);?></div>
    <?php if (isset($data['data.record']['content.cover'])) : ?>
    <br>
		<img src="<?php $this->e($l->gen('/public/media/' . $data['data.book']['book.cover']['name'] . '_p.' . $data['data.book']['book.cover']['extension']));?>" alt="" >
    <?php endif; ?>
    </div>

    <div id="slides" class="slider columnthird content clearfix">
      <div class="slides_container">

		<?php if (isset($data['data.book']['book.album'])) : foreach ($data['data.book']['book.album'] as $g) :
?>

        <div class="slide">
          <figure>
			<a href="<?php $this->e($l->gen('media') . '/' . $g['name'] . '.' . $g['extension']);?>" target="_blank">
				<img src="<?php $this->e($l->gen('media') . '/' . $g['name'] . '_m.' . $g['extension']);?>" alt="" >
			</a>
          </figure>
        </div>

		<?php
endforeach; endif;?>

      </div>
    </div>

  </section>
</div>
