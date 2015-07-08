<div class="works center part clearfix">
  <aside class="column4 mright">

	<p><a href="<?php echo $l->gen('index.php/blog');?>" class="arrow">Blog</a></p>

	<ul>
	<?php
		foreach ($conteudo['blog']['conteudo'] as $dado) :
			if (isset($dado['corpo'])) :		 
	?>	
			<li>
					<p>
						<?php echo $dado['corpo'];?>
					</p>
					<?php if (isset($dado['tag'])) :?>
						<p><a href="http://ronymaltz.tumblr.com/tagged/<?php echo $dado['tag'];?>"><?php echo $dado['tag'];?></a><p>
					<?php endif;?>
					
					<?php if (isset($dado['link'])) :?>
						<a href="<?php echo $dado['link']?>" target="_blank" class="post-title">link</a>
					<?php endif;?>
			</li>
	<?php
			endif;
		endforeach;
	?>

	</ul>

  </aside>
  
  <section class="columnthird content clearfix">
  
	<?php foreach($conteudo['projetos']['conteudo'] as $dado) : ?>	

	<figure class="work">
      <a href="<?php echo $l->gen('index.php/projeto/'.$dado['projetoId']);?>" >
	    <img src="<?php echo $l->gen('/public/media/'.$dado['capaProjeto']['nome'].'_p.'.$dado['capaProjeto']['extensao']);?>" alt="" >
	    <span class="zoom"></span>
	  </a>

      <figcaption> 
		<a href="<?php echo $l->gen('index.php/projeto/'.$dado['projetoId']);?>#seta-ant" class="arrow pt-br">
			<?php echo $dado['titulo'];?>
		</a>
		<p class="pt-br">
			<?php echo $dado['descricao'];?>
		</p>
		<p class="pt-br">
			<?php echo $dado['corpo'];?>
		</p>
		<a href="<?php echo $l->gen('index.php/projeto/'.$dado['projetoId']);?>#seta-ant" class="arrow en-us">
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

	<?php foreach($conteudo['zines']['conteudo'] as $dado) : ?>	

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
