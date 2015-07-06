<div class="main center">
 <section class="part clearfix">
    <header class="title clearfix">
    <div class="column4 mright">
		<h5 class="pt-br"><?php $this->e($data['data.record']['title']);?></h5>
		<h5 class="en-us"><?php $this->e($data['data.record']['title_en']);?></h5>
		<div class="pt-br"><?php $this->e($data['data.record']['body']);?></div>
		<div class="en-us"><?php $this->e($data['data.record']['body_en']);?></div>
    <?php if (isset($data['data.record']['content.cover'])) : ?>
    <br>
		<img src="<?php $this->e($l->genImg($data['data.record']['content.cover'], 'p'));?>" alt="" >
    <?php endif; ?>
    </div>
    <div id="slides" class="slider columnthird content clearfix">
      <div class="slides_container">

		<?php //var_dump(array_keys($data)); 
    if (isset($data['data.record']['content.album'])) : foreach ($data['data.record']['content.album'] as $g) :
?>

        <div class="slide">
          <figure>
			<a href="<?php $this->e($l->genImg($g, 'm'));?>" target="_blank">
				<img src="<?php $this->e($l->genImg($g));?>" alt="" >
			</a>
          </figure>
        </div>

		<?php
endforeach; endif;?>

      </div>
    </div>
  </section>
</div>
