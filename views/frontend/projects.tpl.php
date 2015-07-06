<div class="works center part clearfix">
  <header class="title">
	<p class="fleft pt-br">Livros</p>
	<p class="fleft en-us">Books</p>
  </header>
  <aside class="column4 mright">
	<p class="mbottom pt-br"><?php if (isset($sidebar)) {echo $sidebar['body'];}?></p>
	<p class="mbottom en-us"><?php if (isset($sidebar)) {echo $sidebar['body_en'];}?></p>
	
	<a class="all en-us more">all</a><br class="en-us">
	<a class="all pt-br more">todos</a><br class="pt-br">
	<?php
     $types = $config['types'];
    foreach ($types as $type) {
           echo '<a class="'.$type[0].'Cat pt-br more">'.$type[1][0].'</a><br class="pt-br">';
           echo '<a class="'.$type[0].'Cat en-us more">'.$type[1][1].'</a><br class="en-us">';
    }
    ?>

  </aside>
  
  <section class="columnthird content clearfix">

	<?php if (isset($data['data.list']) && is_array($data['data.list']) && !empty($data['data.list'])) : foreach ($data['data.list'] as $item) :
?>	

	<figure class="work  <?php echo $item['type'];?>">
    <?php if (isset($item['content.cover'])) : ?>
      <a href="<?php echo $l->gen('/content/'.$item['id']);?>" >
	    <img src="<?php echo $l->gen('/public/media/'.$item['content.cover']['name'].'_p.'.$item['content.cover']['extension']);?>" alt="" >
	    <span class="zoom"></span>
	  </a>
    <?php endif; ?>
      <figcaption> 
		<a href="<?php echo $l->gen('/content/'.$item['id']);?>#seta-ant" class="arrow pt-br">
			<?php echo $item['title'];?>
		</a>
		<p class="pt-br">
			<?php echo $item['description'];?>
		</p>
		<p class="pt-br">
			<?php echo $item['body'];?>
		</p>
		<a href="<?php echo $l->gen('/content/'.$item['id']);?>#seta-ant" class="arrow en-us">
			<?php echo $item['title_en'];?>
		</a>
		<p class="en-us">
			<?php echo $item['description_en'];?>
		</p>
		<p class="en-us">
			<?php echo $item['body_en'];?>
		</p>
      </figcaption>
    </figure>

	<?php
endforeach;endif; ?>

  </section>

</div>
