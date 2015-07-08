<div class="works center part clearfix">
  <header class="title">
	<p class="fleft pt-br">Livros</p>
	<p class="fleft en-us">Books</p>
  </header>
  <aside class="column4 mright">
	<p class="mbottom pt-br"><?php echo $lateral['corpo'];?></p>
	<p class="mbottom en-us"><?php echo $lateral['corpo_en'];?></p>
  </aside>
  
  <section class="columnthird content clearfix">

	<?php foreach($conteudo as $dado) : ?>	

	<figure class="work">
      <a href="<?php echo $l->gen('index.php/zine/'.$dado['zineId']);?>" >
	    <img src="<?php echo $l->gen('/public/media/'.$dado['capaZine']['nome'].'_p.'.$dado['capaZine']['extensao']);?>" alt="" >
	    <span class="zoom"></span>
	  </a>

      <figcaption> 
		<a href="<?php echo $l->gen('index.php/zine/'.$dado['zineId']);?>#seta-ant" class="arrow pt-br">
			<?php echo $dado['titulo'];?>
		</a>
		<p class="pt-br">
			<?php echo $dado['descricao'];?>
		</p>
		<p class="pt-br">
			<?php echo $dado['corpo'];?>
		</p>
		<a href="<?php echo $l->gen('index.php/zine/'.$dado['zineId']);?>#seta-ant" class="arrow en-us">
			<?php echo $dado['titulo_en'];?>
		</a>
		<p class="en-us">
			<?php echo $dado['descricao_en'];?>
		</p>
		<p class="en-us">
			<?php echo $dado['corpo_en'];?>
		</p>
      </figcaption>
    </figure>

	<?php endforeach; ?>

  </section>

</div>
